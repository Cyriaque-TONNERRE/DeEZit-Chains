<?php
$id = $_GET['id'];
$crypt = [
    "r76l9qKbmIK99rWS8a7VU7f8L3cG",
    "f563uMDgf0RV2G0zK7694qmTNbEr",
    "hV893H6r1hO1f9A7rBvsM6b8VEcG",
    "SeZ6P6YM2Ju374nzRP9sL57k6gud",
    "7eKLN5zba2LC1cl1x4FQuC057Gy0",
    "Q4S69F0L9FpuqvHSy72tQd5uR04e",
    "c7HvVf5x73lE8417QGvOi0NU9glZ",
    "h4eM0Jo9R0S0d1WS8lr4B33xsbQR",
    "y56R44sNnSwHDX4yB733D0l2dhuI",
    "Tkk3970gM2B07pzMbeB3w3TVOU9u",
    "01o69GKV6hlFDHkZ1l265Hxw5Ieh",
    "K2f1U1l4jwTf3g34EPP4m92nDSNv",
    "yIr3BKJ56797L86Tf9PwcxxoDYn7",
    "409JU78RzJ6GfmV9BuitI6V1q0ib",
    "X2vA7tYV5k6qQ5gh2e5kWH8zI7S3",
    "hokL397fg8CAJG8GVDT2t5qbl783",
    "9WqLa0JYb2UlG68g494Wh9Kgb4Oc",
    "31OkSasJt019f1XX88mVTHufq5H1",
    "l5lO4YZ5me994Beb3dkP4gFE89YK",
    "pxzMZ3SW52BS53F1Iu70juyd2T5l",
    "rJ1wJA6EhBq2Tpk5Z3iG93Xf23j4",
    "ya7qI3i2w7J5Kj0JGTEs41Ya2zJ2",
    "8V4m9c5tXwbaoDC55N8VsNC2T68l",
    "e91ffb9FZ9838gQ1uuz84TTVYaUT",
    "O28q086AOL3A7Egfx742ipXuvqBU",
    "7z5NHmuKFQjYKnin097942zI4Sb9",
    "PX2c4ikX434V3nlXgoPYhm7O198K",
    "86ouD2pjmB9vZ2Y0pbEO170AR0cI",
    "8f2069BaypUX02PH3cg4NBI8sczI",
    "48tvECynbSwD4AMDr210914Epa5E",
    "x56BN7A4MfO1qvmYcqJ7r61OQ22q",
    "oEovN9wH5d6m670lNK3I55JpEEz4",
    "zQ4Ps83f7a45fCGo3A4q6FXujM4U",
    "lPW64J8ezS1y85487zKJbuhD9KcC",
    "ar3vU5vZ391IoKd96OA8sOA5Zed3",
    "8PO3CAc2ptQ4rlw6X93ueL4W1Uw6",
    "1v0nVRWW6A5rq2anf25J67LY5Zbm",
    "6aGsgS4J0B4Qc5I9G4jb0VxmH6g9",
    "f5g2Bf5k9cA9NTK50oB2oNN5r5Wa",
    "qq0mJxcdo47657GvOVU77Z99xPPB",
    "P9YiwghYca8O8CX4P66qXGj055s9",
    "80XdbLh8o1uS6W26sSTNm43f8KqR",
    "Bq4BJS4311havW97lqD25nhLfR7C",
    "ONL0nM02817waQ1g4mG3vHfvU2Yz",
    "96G17W8UqQFvt3OyB5p3i1vb0LpC",
    "1x79rAG04bTQF5iKcc62mgD5KwV8",
    "DqBtbmA292q18k22T0q5SvHAWaI6",
    "UgA3jy8t4767w1Q0x29KRYoGmoUW",
    "Y3iNo2M3292Jn6WCR4p4ewxlMb8R",
    "0eWDwH3EVnl3A9R2U6klvd96Z03d",
    "Va46t1u8ztGQU42sUouF3n2Q7RQ1",
    "8csPT8qBaPQ51Lx490ZzeP1Bmr93",
    "Ldc9uhDG6ETt8SQvg383QMm5584d",
    "I9MN3RthpkpTGQ9964IeP15q98tk",
    "85m948iZInGuXue5I60hOX3qX9kK",
    "USBBf7WlK8V41p3jqiuT19191Puu",
    "jmKlKjZgCK460r86X6uH2wDB200j",
    "EqeTY9Vuv8YT3N1G1O91bv7tz6d5",
    "g42DB83P7bx1wbXDz30nbVQW2X6l",
    "d0M4kY0y17VoG7PfjVN892eoKF8q"
];
$decrypted_id = array_search($id,$crypt);
$next_id = $decrypted_id +1;
if ($_COOKIE("id") == $id) {
    if ($decrypted_id > 50) {
        header("Location: ./congrats_history.php");
    } else {
        header("Location: ./affichage_history.php?id=$crypt[$next_id]");
    }
} else {
    header("Location: ./index.php");
}

exit();