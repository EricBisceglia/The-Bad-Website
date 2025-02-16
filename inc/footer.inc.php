<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                            THIS PAGE CAN ONLY BE RAN IF IT IS INCLUDED BY ANOTHER PAGE                            */
/*                                                                                                                   */
// Include only /*****************************************************************************************************/
if(substr(dirname(__FILE__),-8).basename(__FILE__) === str_replace("/","\\",substr(dirname($_SERVER['PHP_SELF']),-8).basename($_SERVER['PHP_SELF']))) { exit(header("Location: ./../404")); die(); }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Prepare the footer's contents

// Load time and query count
$load_time  = round(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 3);
$metrics    = __('footer_loadtime').$load_time.'s'.__('with', 1, 1, 1).$GLOBALS['query'].__('query', $GLOBALS['query'], 1);

// Copyright ending date
$copyright_date = date('Y');




/*********************************************************************************************************************/
/*                                                                                                                   */
/*                                                DISPLAY THE FOOTER                                                 */
/*                                                                                                                   */
/******************************************************************************************************************/ ?>

      <?php if(!isset($hide_footer)) { ?>

      <footer>

        <?=__link("pages/social/legal", __('footer_legal'), "text_light text_white_hover", true, $path);?><br>

        <?=__link("pages/social/copyright", __('footer_copyright', preset_values: array($copyright_date)), "text_light text_white_hover", true, $path);?><br>

      </footer>

      <?php } ?>

    </div>

  </body>
</html>