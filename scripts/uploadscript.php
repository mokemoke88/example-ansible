#!/usr/bin/php71
<?php

/**
 * @file /usr/local/bin/uploadscript.php
 * @brief pure-ftpdのアップロード完了時フック
 */

/**
 * @brief アプリケーションエントリポイント
 */
function main($argv)
{
    umask(000);
    if( !($fp = @fopen("/var/tmp/temp.txt", 'a+')) )
    {
        return;
    }

    fprintf($fp, "UPLOAD_FILEPATH: %s\n", $argv[1]);
    fprintf($fp, "UPLOAD_SIZE: %d\n", getenv("UPLOAD_SIZE"));
    fprintf($fp, "UPLOAD_PARMS: %s\n", getenv("UPLOAD_PARMS"));
    fprintf($fp, "UPLOAD_UID: %d\n", getenv("UPLOAD_UID"));
    fprintf($fp, "UPLOAD_GID: %d\n", getenv("UPLOAD_GID"));
    fprintf($fp, "UPLOAD_USER: %s\n", getenv("UPLOAD_USER"));
    fprintf($fp, "UPLOAD_GROUP: %s\n", getenv("UPLOAD_GROUP"));
    fprintf($fp, "UPLOAD_VUSER: %s\n", getenv("UPLOAD_VUSER"));

    fclose($fp);
}

main($argv)
?>
