<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim($request->q);

        if (!$keyword) {
            return redirect()->route('home');
        }

        $services = Service::query()
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                      ->orWhere('description', 'LIKE', "%{$keyword}%")
                      ->orWhere('benefits', 'LIKE', "%{$keyword}%");
            })
            ->orderBy('name')
            ->get();

        return view('pages.search_results', [
            'keyword'  => $keyword,
            'services' => $services,
        ]);
    }
}
