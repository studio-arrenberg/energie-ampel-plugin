<?php

// get API
$url = "http://api.energiewetter.de/";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($curl);
curl_close($curl);

// decode for readout
$res = json_decode($resp, true);
?>

<!-- energie ampel -->
<div id="overlay" class="overlay hidden">

<div class="overlay-content">
    <button class="button  " onclick="hide()">
    
    <!-- <?php require get_template_directory() . '/assets/icons/person.svg'; ?> -->
        <?php _e('Zurück', 'quartiersplattform'); ?></span>
    </button>
    <?php // get_template_part('components/energie_ampel-menu'); ?>


        <div class="energie-ampel">

            <div class="energie-ampel-titles">
                <div>
                    <?php echo get_locale(); ?>
                    <?php if (is_user_logged_in()) echo get_user_locale(get_current_user_id()); ?>
                    <h2><?php _e('Energie Ampel', 'quartiersplattform'); ?> <span><?php _e('für', 'quartiersplattform');?> Wuppertal</span></h2>
                    <h3 class="<?php echo $res['current']['color']; ?>"><?php echo __($res['current']['label']['plural'], 'quartiersplattform')." "; ?><?php _e('Phase', 'quartiersplattform'); ?></h3>
                </div>

                <div>
                    <h2><?php echo $res['current']['emissions']['amount']." ".__('gramm', 'quartiersplattform'); ?></h2>
                    <h3><?php echo "CO<sub>2</sub> ".__('pro kWh', 'quartiersplattform'); ?> </h3>
                </div>
            </div>

            <?php // _e('Tuesday', 'Wordpress');?>

            <div class="strom_array-container">
                <div class="strom_array">
                    <div class="<?php echo $res['current']['color']; ?>"><label class="day"><?php _e('Jetzt', 'quartiersplattform'); ?></label></div>

                        <?php 
                        // iterate array
                        foreach ($res['forecast'] as $timeline => $item) {

                            $label = '';
                            if ($color != $item['color']) $label = "<label>".$item['time']."</label>";
                            if (strftime('%A', $timeline) != strftime('%A', $unix)) echo "<label class='midnight'>".__(strftime('%A', $timeline))."</label>";
                            
                            echo "<div class='".$item['color']."'>$label</div>";

                            $color = $item['color']; 
                            $unix = $timeline; 
                        }
                        ?>

                </div>
            </div>
        </div>

        <div class="vpp-animation">
            <!-- <img class="vpp-animation <?php echo $res['current']['color']; ?>" src="<?php echo plugin_dir_path( __FILE__ ).'assets/Energie-Ampel-Animation_'.$res['current']['color'].'.svg'; ?>"> -->
            <?php include_once( plugin_dir_path( __FILE__ ) . 'assets/Energie-Ampel-Animation_'.$res['current']['color'].'.svg' ); ?>
        </div>


        <script>

            energieAmpel = false;   
            
            function show() {
                // show
                if (energieAmpel == false) {
                
                    var element = document.getElementById("overlay");
                    element.classList.remove("hidden");
                    element.classList.add("visible");

                    var htmlElement = document.getElementsByTagName("html")[0];
                    htmlElement.classList.add("no-scroll");

                    document.querySelector("a.energie-ampel-button").classList.add('is-primary');
                    energieAmpel = true;
                
                }
                // hide
                else {
                    hide();  
                }
            }

            function hide() {
                energieAmpel = false;

                var element = document.getElementById("overlay");
                element.classList.remove("visible");
                element.classList.add("hidden");

                var htmlElement = document.getElementsByTagName("html")[0];
                htmlElement.classList.remove("no-scroll");

                document.body.style.overflowY = "scroll";
                document.querySelector("a.energie-ampel-button").classList.remove('is-primary');
            }
        </script>

    </div>
</div>