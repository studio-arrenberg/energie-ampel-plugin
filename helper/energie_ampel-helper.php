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
            <?php _e('Zurück', 'quartiersplattform'); ?></span>
    </button>

    <div class="energie-ampel-title">
                    <?php echo get_locale(); ?>
                    <?php // if (is_user_logged_in()) echo get_user_locale(get_current_user_id()); ?>
                    <h2><?php _e('Energie Ampel', 'quartiersplattform'); ?> <span><?php _e('für', 'quartiersplattform');?> Wuppertal</span></h2>
                    <h3 class="<?php echo $res['current']['color']; ?>"><?php echo __($res['current']['label']['plural'], 'quartiersplattform')." "; ?><?php _e('Phase', 'quartiersplattform'); ?></h3>

               
            </div>

        <div class="energie-ampel">

           

            <?php // _e('Tuesday', 'Wordpress');
            ?>

            <div class="strom_array-container">
                <div class="strom_array">
                    <div class="<?php echo $res['current']['color']; ?>"><label class="day"><?php _e('Jetzt', 'quartiersplattform'); ?></label></div>

                        <?php 
                        // iterate array
                        foreach ($res['forecast'] as $timeline => $item) {

                            $label = '';
                            if ($color != $item['color']) $label = "<label>".$item['time']."</label>";
                            if (strftime('%A', $timeline) != strftime('%A', $unix)) echo "<label class='midnight'>".__(strftime('%A', $timeline), "twentytwenty")."</label>";
                            
                            echo "<div class='".$item['color']."'>$label</div>";

                            $color = $item['color']; 
                            $unix = $timeline; 
                        }
                        ?>

                </div>
            </div>
        </div>

        <div class="vpp-animation">
            <div class="large-margin-bottom">
                <h3> Aktueller Emissionsfaktor</h3>
                <h2 class="heading-size-1 <?php echo $res['current']['color']; ?>"><?php echo $res['current']['emissions']['amount']." ".__('gramm', 'quartiersplattform'); ?></h2>
                <h4><?php echo "CO<sub>2</sub> ".__('pro kWh', 'quartiersplattform'); ?></h4> 
            </div>

            
            <?php include_once( plugin_dir_path( __FILE__ ) . 'assets/Energie-Ampel-Animation_'.$res['current']['color'].'.php' ); ?>
        </div>

       
        <div>
            <h3>Die Energie Ampel erklärt</h3>
            <p><?php _e("Der Strom, den wir verbrauchen hat zu jeder Tages- und Nachtzeit einen unterschiedlich hohen CO2-Ausstoß. Je nachdem wie viel regional und regenerativ produzierter Strom gerade real im Netz fließt und wie hoch der gesamtstädtische Verbrauch ausfällt. Wird zum Beispiel gerade viel Windkraft aus Norddeutschland, Solarenergie aus dem Süden oder eigener Produktion geliefert, sinkt der gegenwärtige, reale CO2-Ausstoß. Die Wuppertaler Stadtwerke berechnen seit einigen Jahren diesen realen und stundengenauen CO2-Ausstoß hinter dem Strom, den wir verbrauchen. Zusammen mit der Bergischen Universität und dem Klimaquartier Arrenberg wurden diese Berechnungen in Raster übertragen und das hier sichtbare Energiewetter entwickelt. Es zeigt in den Phasen grün, gelb und rot in drei Stufen an, ob der CO2-Ausstoß jetzt gerade bzw. in den kommenden Stunden und Tagen hoch oder niedrig ist. Verlagerung statt Verzicht. Bestehende Geräte nutzen statt sofort neu kaufen zu müssen. Auf diesem Wege kann jeder Haushalt, unabhängig von den eigenen finanziellen Möglichkeiten an der Energiewende und dem Klimaschutz mitwirken. Das löst zwar noch nicht alle Probleme, ist aber ein smarter Schritt, den alle gehen können. ",'quartiersplattform'); ?></p>
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