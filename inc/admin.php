<?php

function wordpress_post_navigation_admin_pages() {
    ?>
    <style type="text/css">
        #gif,#gif1,#gif2,#gif3
        {
            width:100%;
            height:100%;
            display:none;
            margin-left: 393px;
        }

        #result,#result1,#result2,#result3
        {
            display:none;
            border-color:#e8426d;
            background-color:#FFFFFF;
            color:#e8426d;
            border: solid;
            width:160px;
            text-align: center;
            margin-left: 389px;
        }

        #resets1
        {
            background-color:#2687b2;
            display:none;
            border-color:#FFFF00;
            border-width:thick;
            width:160px;
        }



    </style>
    <script type="text/javascript">
        function show_url() {
            document.getElementById('url').style.display = 'inline';

        }
        function hide_url() {
            document.getElementById('url').style.display = 'none';
        }
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('#submit_general').click(function($)
            {
                jQuery('#gif').css("display", "block");


            });
        });
        function submitgeneral() {
            jQuery.ajax({type: 'POST', url: 'options.php', data: jQuery('#form_general').serialize(), success: function(response) {


                    jQuery('#gif').css("display", "none");
                    jQuery('#result').css("display", "block");
                    jQuery('#result').html("Settings Saved");
                    jQuery('#result').fadeOut(2500, "linear");
                }});

            return false;
        }

    </script>
    <link href ="<?php echo WP_CONTENT_URL; ?>/plugins/wp-post-navigator/css/admin_style.css" type="text/css" rel="stylesheet"/>
    <div class="wrap">
        <?php
        $bpageheader = true;
        if ($bpageheader == true) {
            ?>
            <div class="ic"></div>
            <a href="http://fantasticplugins.com" target="_blank"><h2 style="text-align: left;"><img style="position:relative;top:66px;" src="<?php echo WP_CONTENT_URL; ?>/plugins/wp-post-navigator/assets/favicon.png"/></h2></a><br/><br/>
            <h2 style="text-align: right;margin-top:-160px;"><label><strong>Check Out Our Pro Version</strong></label></h2>
            <a href="http://fantasticplugins.com/shop/awesome-previous-next-post-navigator" target="_blank"><h2 style="text-align: right;"><img style="height: 200px;
                                                                                                                                                width: 315px;" src="<?php echo WP_CONTENT_URL; ?>/plugins/wp-post-navigator/assets/previousnext.jpg"/></h2></a>
                                                                                                                                            <?php } ?>
        <div class="left">

            <div class="metabox-holder4">
                <div class="postbox4">
                    <h3>General Settings</h3>
                    <div class="inside4">
                        <form id="form_general" onsubmit="return submitgeneral();">
                            <?php $opti = get_option('post_navigation_on'); ?>
                            <?php $options = get_option('post_navigation_title'); ?>
                            <?php
                            $oopti = get_option('post_navigation_image_link');
                            $credit_links = get_option('post_credit_link');
                            ?>
                            <?php settings_fields('wordpress_post_navigation_button'); ?>
                            <ul>
                                <li>
                                    <label>Disable this Plugin</label>
                                    <input type="checkbox" class="checkbox_general" name="post_navigation_on" style="margin-left:257px;" value="1"<?php checked('1', $opti); ?>/>
                                </li>
                                <li>
                                    <label>Credit Link</label>
                                    <input type="radio" class="radiobox_general" name="post_credit_link" style="margin-left:310px;" value="1"<?php checked('1', $credit_links); ?>/><label>&nbsp;ON</label><br/>
                                    <input type="radio" class="radiobox_general" name="post_credit_link" style="margin-left:393px;" value="2"<?php checked('2', $credit_links); ?>/><label>&nbsp;OFF</label><br/>
                                </li>
                            </ul>
                            <br/><br/>
                            <style type="text/css">
                                .fb > input[type=radio]{
                                    display:none;
                                }
                                input[type=radio] + img{
                                    cursor:pointer;
                                    border:2px solid transparent;
                                }
                                input[type=radio]:checked + img{
                                    border:2px solid #f00;
                                }
                            </style>
                            <ul>
                                <li>
                                    <label>Button Style</label>
                                </li>
                            </ul>
                            <table id="auto" style="margin-top:-55px;margin-left:426px;">
                                <?php
                                $directory_number = 1;
                                for ($row = 1; $row <= 1; $row++) {
                                    ?>
                                    <tr>
                                        <?php
                                        $i = 0;
                                        $j = 0;
                                        for ($i = 1, $j = 1; $i <= 5; $i++, $j = $j + 2) {
                                            $directory_name_temp = "/wp-post-navigator/assets/type";
                                            $directory_slash = "/";
                                            $directory_name = $directory_name_temp . $directory_number;
                                            $directory_name = $directory_name . $directory_slash;

                                            //Dynamically generate the file name
                                            $file_name_temp = ".png";
                                            $file_name_previous = $j;
                                            $file_name_previous = $file_name_previous . $file_name_temp;
                                            $file_name_next = $j + 1;
                                            $file_name_next = $file_name_next . $file_name_temp;

                                            $full_file_name_previous = $directory_name . $file_name_previous;
                                            $full_file_name_next = $directory_name . $file_name_next;
                                            $fb_number = ((($row - 1) * 10) + $i);
                                            ?>

                                            <td>
                                                <label class="fb" for='fb<?php echo $fb_number; ?>'>
                                                    <input id="fb<?php echo $fb_number; ?>" type="radio" name="post_navigation_image_link" value="<?php echo $fb_number; ?>"<?php checked($fb_number, $oopti); ?> />

                                                    <img src="<?php
                                                    echo WP_PLUGIN_URL .
                                                    $full_file_name_previous;
                                                    ?>">
                                                </label>
                                            </td>
                                            <?php
                                        }
                                        $directory_number++;
                                        ?>
                                    </tr>
                                    <?php
                                }
                                ?>




                            </table><br/>
                            <br/>


                            <div id="gif"><img src="<?php echo WP_PLUGIN_URL; ?>/wp-post-navigator/images/bar.gif"/></div>
                            <div id="result"></div>
                            <p class="submit">
                                <input type="submit" value="Save" id="submit_general" name="submit" class="button-primary"/>
                            </p>
                        </form>
                        <form method="post" class="form-1" style="margin-top:-46px;">
                            <input type="submit" value="Reset" name="reset" class="button-secondary"/>
                            <br/><br/><br/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $bpageside1 = true;
    if ($bpageside1 == false) {
        ?>
        <div class="metabox-holder_lp">
            <div class="postbox_lp"  >
                <h3 class="ad">Want More Fantastic WordPress Plugins?</h3>
                <div class="inside_lp">
                    <p><strong>If you are not a Member of Fantastic Plugins, try becoming a <a href="http://fantasticplugins.com/" target="_blank">Fantastic Plugins Member</a>. Afterall each Fantastic WordPress Plugin will cost less than a $1 for Members.</strong></p>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php
    $bpageside2 = true;
    if ($bpageside2 == false) {
        ?>
        <div class="metabox-holder_latest">
            <div class="postbox_latest"  >
                <h3 class="ad">Latest News</h3>
                <div class="inside_latest">
                    <?php
                    $new = file_get_contents("http://fantasticplugins.com/blog/feed");
                    $x = new SimpleXmlElement($new);
                    echo "<ul>";
                    $i = 0;
                    foreach ($x->channel->item as $entry) {
                        if ($i == 5)
                            break;
                        echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";
                        $i++;
                    }
                    echo "</ul>";
                    ?>
                </div>
            </div>
        </div>
        </div>
        </div>

        <?php
    }
}
?>