<?php

namespace App\Http\Controllers;

use App\Interface\AltalanosInterface;
use App\Service\FeltoltoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeltoltoController extends Controller implements AltalanosInterface
{
    private FeltoltoService $feltoltoService;

    public function __construct()
    {
        $this->feltoltoService = new FeltoltoService();
    }

    public function list(Request $request)
    {
        //megyék lekérdezése az alap oldalhoz:
        $megyek = $this->feltoltoService->lekerMegyeket();

        return view("home", [
            "megyek" => $megyek
        ]);
    }

    public function kezdolap(Request $request)
    {
        //megyék lekérdezése az alap oldalhoz:
        $megyek = $this->feltoltoService->lekerMegyeket();

        return view("kezdolap", [
            "megyek" => $megyek
        ]);
    }

    public function leker(Request $request)
    {
        $validator = Validator::make([
            "me_id" => $request["meid"]
        ], [
            "me_id" => "required"
        ], [
            "me_id.required" => "Kötelező kitölteni a megyét."
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all("<br>");
        } else {
            return $this->feltoltoService->lekerMegyekhezVarosokat($validator->validated()["me_id"]);
        }
    }

    public function save(Request $request)
    {
        $validator = Validator::make([
            "me_id" => $request["meid"],
            "ujvaros" => $request["ujvaros"],
        ], [
            "me_id" => "required",
            "ujvaros" => "required|max:30",
        ], [
            "me_id.required" => "Kötelező kitölteni a megyét.",
            "ujvaros.required" => "Kötelező kitölteni a várost.",
            "ujvaros.max" => "Max 30 karakter lehet.",
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all(":message <br>");
        } else {
            return $this->feltoltoService->mentUjVarost($validator->validated());
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make([
            "me_id" => $request["meid"],
            "torlendoNev" => $request["torlendoNev"],
        ], [
            "me_id" => "required",
            "torlendoNev" => "required|max:30",
        ], [
            "me_id.required" => "Kötelező kitölteni a megyét.",
            "torlendoNev.required" => "Kötelező kitölteni a várost.",
            "torlendoNev.max" => "Max 30 karakter lehet.",
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all("<br>");
        } else {
            return $this->feltoltoService->torolVarost($validator->validated());
        }
    }

    public function edit(Request $request)
    {
        $validator = Validator::make([
            "me_id" => $request["meid"],
            "ujNev" => $request["ujNev"],
            "regiNev" => $request["regiNev"]
        ], [
            "me_id" => "required",
            "ujNev" => "required|max:30",
            "regiNev" => "required|max:30",
        ], [
            "me_id.required" => "Kötelező kitölteni a megyét.",
            "ujNev.required" => "Kötelező kitölteni a várost.",
            "regiNev.required" => "Kötelező kitölteni a várost.",
            "ujNev.max" => "Max 30 karakter lehet.",
            "regiNev.max" => "Max 30 karakter lehet.",
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all("<br>");
        } else {
            return $this->feltoltoService->szerkesztVarost($validator->validated());
        }
    }
}
