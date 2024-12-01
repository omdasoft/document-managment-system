<?php

namespace Modules\Jobs\Services;

use App\Enums\ModuleType;
use App\Interfaces\DocumentInterface;
use App\Traits\Encryptable;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Jobs\Models\Document;

class DocumentService implements DocumentInterface
{
    use Encryptable;

    public function list(array $filters = [])
    {
        //TODO: get all documents and
    }

    public function create(array $data)
    {
        DB::transaction(function () use ($data) {
            $document = new Document;
            $document->user_id = Auth::user()->id ?? 1;
            $document->title = $data['title'];
            $document->module = ModuleType::GENERAL->value;
            $document->metadata = $data['metadata'] ? json_encode($data['metadata']) : '';
            $document->encryption_key = $this->generateEncryptionKey();
            $document->save();

            $document->documentHeader()->create([
                'encrypted_header' => $this->encryptData($data['header']),
            ]);

            $document->documentBody()->create([
                'encrypted_body' => $this->encryptData($data['body']),
                'checksum' => $this->generateChecksum($data['body']),
            ]);
        });
    }

    public function update(int $id, array $data) {}

    public function delete(int $id) {}

    public function show(int $id)
    {
        $res = [];

        $document = Document::with(['documentHeader', 'documentBody'])->findOrFail($id);

        if (! $document) {
            throw new Exception('Model not found', 404);
        }

        $encrypedHeader = $document->documentHeader->encrypted_header;

        $header = $this->decryptData($encrypedHeader);

        $encrypedBody = $document->documentBody->encrypted_body;

        $body = $this->decryptData($encrypedBody);

        $validateChecksum = $this->validateChecksum($body, $document->documentBody->checksum);

        if (! $validateChecksum) {
            throw new Exception('The body checksum does not match', 400);
        }

        $res['title'] = $document->title;
        $res['header'] = $header;
        $res['body'] = $body;

        return $res;
    }
}
