<?php
return [
    'exception_handle' => function (Exception $e) {
        return json($e->getMessage(), 444);
    },
];