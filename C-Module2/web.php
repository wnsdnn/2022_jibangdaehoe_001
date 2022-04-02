<?php

$get(
    "/@View@indexPage",
    "/sub1@View@sub1Page",
    "/sub2@View@sub2Page",
    "/sub3@View@sub3Page",


    "/admin@View@adminPage",
    "/detail@View@detailPage",
    "/admin_specialty@View@adminSpecialtyPage",
    "/admin_event@View@adminEventPage",

    "/api/event/:tel/stamps@Api@stampApi",
    "/api/reviews@Api@reviewList",
);

$post(
    "/admin@View@adminProccess",
    "/detail@View@detailProccess",

    "/api/event/applicants@Api@eventApi",
    "/api/reviews@Api@reviewsApi",
);

