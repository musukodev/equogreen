<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function success($message)
{
    return redirect()->back()->with('success', $message);
}
}
