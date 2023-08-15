<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class ICDController extends Controller
{

    public function index()
    {
        return view('icd.index');
    }

    public function login()
    {
        return Socialite::driver('icd')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('icd')->user();

        return view('icd.search', compact('user'));
    }

    public function search(Request $request)
    {
        $clientId = '96470ef0-e317-4232-a142-c06d84fce3ea_56b62772-481d-4991-8936-6c70dc3d800f';
        $clientSecret = 'LRGCgeddbXAt3EdtlYqcVYgG9SH27J2JrvXHTNURooc=';

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->asForm()->post("https://icdaccessmanagement.who.int/connect/token", [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => 'icdapi_access',
        ]);

        $token = $response->json()['access_token'];

        $apiResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            'API-Version' => 'v2',
            'Accept-Language' => 'en',
        ])->get('https://id.who.int/icd/entity/search', [
            'q' => $request->term
        ]);

        if ($apiResponse->successful()) {
            $data = $apiResponse->json();

            return view('icd.index', compact('data'));
        } else {
            return redirect()->back()->with('error', 'Error fetching search results.');
        }
    }

    public function detail(Request $request)
    {
        $clientId = '96470ef0-e317-4232-a142-c06d84fce3ea_56b62772-481d-4991-8936-6c70dc3d800f';
        $clientSecret = 'LRGCgeddbXAt3EdtlYqcVYgG9SH27J2JrvXHTNURooc=';
        $id = $request->input('id');

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->asForm()->post("https://icdaccessmanagement.who.int/connect/token", [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => 'icdapi_access',
        ]);

        $token = $response->json()['access_token'];

        // $id = substr(strrchr($request->id, '/'), 1);

        $apiResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            'API-Version' => 'v2',
            'Accept-Language' => 'id',
        ])->get('https://id.who.int/icd/entity/' . $id);

        if ($apiResponse->successful()) {
            $details = $apiResponse->json();

            return view('icd.detail', compact('details'));
        } else {
            return redirect()->back()->with('error', 'Error fetching search results.');
        }
    }
}
