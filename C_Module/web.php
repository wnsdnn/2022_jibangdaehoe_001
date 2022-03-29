<?php

$get(
    "/@View@main",
    "/sub1@View@sub1",
    "/sub2@View@sub2",
    "/sub3@View@sub3",
    "/admin_specialty@View@adminSpacialtyPage",
    "/admin_event@View@adminEventPage",
    "/detail@View@detailPage",

    "/admin@View@adminPage",
    "/api/event/:tel/stamps@Api@stampApi",
);


$post(
    "/admin@View@adminProccess",
    "/detail@View@detailProccess",
    "/api/event/applicants@Api@eventApi",
    
);
