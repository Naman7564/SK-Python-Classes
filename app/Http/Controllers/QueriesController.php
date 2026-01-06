<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;

class QueriesController extends Controller
{
    /**
     * Get all queries (Admin only)
     */
    public function index()
    {
        $queries = Query::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'queries' => $queries
        ]);
    }

    /**
     * Get a single query
     */
    public function show($id)
    {
        $query = Query::find($id);

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Query not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'query' => $query
        ]);
    }

    /**
     * Create a new query (Public - no auth required)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $query = Query::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your inquiry has been submitted successfully!',
            'query' => $query
        ], 201);
    }

    /**
     * Update query status (Admin only)
     */
    public function updateStatus(Request $request, $id)
    {
        $query = Query::find($id);

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Query not found'
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,resolved',
            'admin_response' => 'nullable|string',
        ]);

        $query->status = $request->status;
        if ($request->has('admin_response')) {
            $query->admin_response = $request->admin_response;
        }
        $query->save();

        return response()->json([
            'success' => true,
            'message' => 'Query status updated successfully',
            'query' => $query
        ]);
    }

    /**
     * Delete a query (Admin only)
     */
    public function destroy($id)
    {
        $query = Query::find($id);

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Query not found'
            ], 404);
        }

        $query->delete();

        return response()->json([
            'success' => true,
            'message' => 'Query deleted successfully'
        ]);
    }
}
