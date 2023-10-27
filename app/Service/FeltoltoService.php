<?php

namespace App\Service;

use App\Models\MegyekModel;
use App\Models\VarosokModel;

class FeltoltoService
{
    public function __construct()
    {

    }

    /**
     * Lekéri az összes megyét
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function lekerMegyeket()
    {
        return MegyekModel::all();
    }

    /**
     * Lekéri a kiválasztott megyékhez a várost
     *
     * @param int $me_id megye id
     * @return mixed
     */
    public function lekerMegyekhezVarosokat(int $me_id)
    {
        return VarosokModel::where("va_meid", "=", $me_id)->get();
    }

    /**
     * Menti az átadott string típusú várost
     *
     * @param array $data
     * @return bool
     */
    public function mentUjVarost(array $data)
    {
        $varos = VarosokModel::where("va_meid", "=", $data["me_id"])
            ->where("va_nev", "=", $data["ujvaros"])
            ->first();

        if (!$varos) {
            $varosok = new VarosokModel();
            $varosok->va_meid = $data["me_id"];
            $varosok->va_nev = $data["ujvaros"];
            return $varosok->save();
        } else {
            return "Már van ilyen!";
        }
    }

    /**
     * Törli az átadott várost
     *
     * @param array $data
     * @return mixed
     */
    public function torolVarost(array $data)
    {
        return VarosokModel::where("va_meid", "=", $data["me_id"])
            ->where("va_nev", "=", $data["torlendoNev"])
            ->first()
            ->delete();
    }

    /**
     * Kikeresi az átírás előtti nevet a megyéhez és az új névre írja át
     *
     * @param array $data
     * @return mixed
     */
    public function szerkesztVarost(array $data)
    {
        $varos = VarosokModel::where("va_meid", "=", $data["me_id"])
            ->where("va_nev", "=", $data["regiNev"])
            ->first();
        $varos->va_nev = $data["ujNev"];
        return $varos->save();
    }
}
