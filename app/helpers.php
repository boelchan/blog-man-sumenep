<?php

use App\Models\Identity;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

function browser_agent($user_agent)
{
    $agent = tap(new Agent(), fn ($agent) => $agent->setUserAgent($user_agent));

    return $agent->platform().' - '.$agent->browser();
}

function checkUuid($fieldUuid)
{
    abort_if((request()->uuid != $fieldUuid), 404);
}

function rupiah($value)
{
    return 'Rp '.number_format((int) $value, 0, ',', '.');
}

function angka($value)
{
    return number_format((int) $value, 0, ',', '.');
}

function setting($tipe)
{
    return Identity::setting($tipe);
}

function tanggal($value)
{
    return Carbon::parse($value)->format('d/m/Y');
}

function tanggalJam($value)
{
    return Carbon::parse($value)->format('d/m/Y H:i');
}
