<x-mail::message>
# Introduction

Hello {{ $email }}!, selamat datang di website kami.

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Salam hangat dari kami. Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
