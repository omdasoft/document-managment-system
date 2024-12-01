<?php

namespace Modules\General\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\General\Http\Requests\DocumentStoreRequest;
use Modules\General\Services\DocumentService;

class DocumentController extends Controller
{
    public function __construct(private DocumentService $documentService) {}

    public function index(Request $request)
    {
        $documents = $this->documentService->list($request->all());
    }

    public function store(DocumentStoreRequest $request)
    {
        $this->documentService->create($request->validated());

        return response()->json('Document created successfully');
    }

    public function show(int $id)
    {
        try {
            $document = $this->documentService->show($id);

            return response()->json($document);
        } catch (ModelNotFoundException $e) {
            return response()->json('Document notfound', 404);
        } catch (Exception $e) {
            Log::info('Error getting the document', [$e->getMessage(), $e->getCode()]);

            return response()->json($e->getMessage());
        }
    }
}
