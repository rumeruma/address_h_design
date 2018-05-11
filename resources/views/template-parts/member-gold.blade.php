@extends('template-parts.member')
@php
    $subscriptions = array();
    $packagename = package_by_name('gold');
        if($packagename){
        $subscriptions = $packagename->memberAsRequired(8);
        }

@endphp

