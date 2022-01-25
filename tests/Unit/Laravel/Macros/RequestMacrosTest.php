<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\assertSame;

it('can return the request as a collection', function () {
    $dummyRequest = null;
    Http::fake();
    Http::post('https://google.com', [
        'foo' => 'bar',
    ]);

    Http::assertSent(function (Request $request) use (&$dummyRequest) {
        $dummyRequest = $request;

        return true;
    });

    assertSame(
        json_decode($dummyRequest->body(), flags: JSON_OBJECT_AS_ARRAY),
        $dummyRequest->collect()->all()
    );
});
