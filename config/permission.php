<?php


$permission =  [

    "ManagementSettings"=>150,
    "BirthManagement"=>160,
    "DeathManagement"=>170,
    "MarriageDivorce"=>180,
    "RegistrationTrustee"=>190,
    "AdoptionChildren"=>200,
    "Reports"=>210,
    "NewBirthCertificates"=>300,
    "NewBirthRequest"=>310,
    "NewBirthPendingTask"=>320,
    "NewBirthProcessingRequest"=>330,
    "NewBirthProcessingTask"=>340,
    "NewBirthIssue"=>350,
    "NewBirthPrinted"=>360,

    //duplicates

    "DuplicateCertificates"=>400,
    "DuplicateRequest"=>410,
    "DuplicatePendingTask"=>420,
    "DuplicateProcessingRequest"=>430,
    "DuplicateProcessingTask"=>440,
    "DuplicateIssue"=>450,
    "DuplicatePrinted"=>460,

    //ChangeCertificateDetails

    "ChangeCertificateDetails"=>500,
    "ChangeCertificateDetailsRequest"=>510,
    "ChangeCertificateDetailsPendingTask"=>520,
    "ChangeCertificateDetailsProcessingRequest"=>530,
    "ChangeCertificateDetailsProcessingTask"=>540,
    "ChangeCertificateDetailsIssue"=>550,
    "ChangeCertificateDetailsPrinted"=>560,

    //ReplaceCertificate

    "ReplaceCertificate"=>600,
    "ReplaceCertificateRequest"=>610,
    "ReplaceCertificatePendingTask"=>620,
    "ReplaceCertificateProcessingRequest"=>630,
    "ReplaceCertificateProcessingTask"=>640,
    "ReplaceCertificateIssue"=>650,
    "ReplaceCertificatePrinted"=>660,

    //verify
    "VerifyCertificate"=>700,
    "VerifyCertificateRequest"=>710,
    "VerifyCertificatePendingTask"=>720,
    "VerifyCertificateProcessingRequest"=>730,
    "VerifyCertificateProcessingTask"=>740,
    "VerifyCertificateIssue"=>750,
    "VerifyCertificatePrinted"=>760,

];


return $permission;
