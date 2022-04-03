<?php


$get(
    "/@View@indexPage",
    "/sub1@View@sub1Page",
    "/sub2@View@sub2Page",
    "/sub3@View@sub3Page",
    "/admin_specialty@View@adminSPage",
    "/admin_event@View@adminEPage",

    "/admin@View@adminPage",
    "/detail@View@detailPage",

    "/api/reviews@Api@reviewListApi",
    "/api/review/:key@Api@reviewDetailApi",

    "/api/event/:tel/stamps@Api@stampApi",

);

$post(
    "/api/reviews@Api@reviewApi",
    "/detail@View@detailProccess",
    "/admin@View@adminProccess",
    "/api/event/applicants@Api@eventApi",
);