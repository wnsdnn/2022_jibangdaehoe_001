<?php

$get(
    "/@View@indexPage",
    "/sub1@View@sub1Page",
    "/sub2@View@sub2Page",
    "/sub3@View@sub3Page",

    "/api/event/:tel/stamps@Api@stampsApi",

    "/admin_specialty@View@adminSpecialtyPage",
    "/admin_event@View@adminEventPage",

    "/admin@View@adminPage",
    "/detail@View@detailPage",
);

$post(
    "/api/event/applicants@Api@eventApi",
    "/admin@View@adminProccess",
    "/detail@View@detailProccess",
);
