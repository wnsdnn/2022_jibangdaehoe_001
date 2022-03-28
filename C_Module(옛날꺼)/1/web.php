<?php


$get(
    "/@View@main",
    "/logout@View@logout",
    "/admin@View@adminPage",
    "/specialty@View@specialtyPage",
    "/specialty_admin@View@adminSpecialtyPage",
    "/event_admin@View@adminEventPage",
    "/specialty_detail@View@detailPage",
    "/event@View@eventPage",
    "/review@View@reviewPage",
    "/reviewList@View@reviewListPage",
    "/reviewTest@View@reviewTestPage",
    "/api/event/:tel/stamps@Event@eventTelApi",
    "/api/reviews@Event@reviewListApi",
    "/api/reviews/:key@Event@reviewDetailApi",
);


$post(
    "/admin@View@adminProcess",
    "/specialty_detail@View@detailProcess",
    "/api/event/applicants@Event@eventApi",
    "/api/reviews@Event@reviewsApi",
);