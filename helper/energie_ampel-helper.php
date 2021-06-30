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
    <button class="button" onclick="hide()">
            <?php _e('Zurück', 'energie-ampel'); ?></span>
    </button>

    <div class="energie-ampel-title">
        <h2><?php _e('Energie Ampel', 'energie-ampel'); ?> <span><?php _e('für', 'energie-ampel');?> Wuppertal</span></h2>
        <h3 class="<?php echo $res['current']['color']; ?>"><?php echo __($res['current']['label']['plural'], 'energie-ampel')." "; ?><?php _e('Phase', 'energie-ampel'); ?></h3>
    </div>

        <div class="energie-ampel">
            <div class="strom_array-container">
                <div class="strom_array">
                    <div class="<?php echo $res['current']['color']; ?>"><label class="day"><?php _e('Jetzt', 'energie-ampel'); ?></label></div>

                        <?php 
                        foreach ($res['forecast'] as $timeline => $item) {

                            $label = '';
                            
                            if (isset($color) && $color != $item['color']) $label = "<label>".$item['time']."</label>";
                            if (isset($unix) && (date('l', $timeline) != date('l', $unix))) echo "<label class='midnight'>".__(date('l', $timeline), "energie-ampel")."</label>";
                            
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
                <h3><?php _e('Aktueller Emissionsfaktor', 'energie-ampel'); ?> </h3>
                <h2 class="heading-size-1 <?php echo $res['current']['color']; ?>"><?php echo $res['current']['emissions']['amount']." ".__('gramm', 'energie-ampel'); ?></h2>
                <h4><?php echo "CO<sub>2</sub> ".__('pro kWh', 'energie-ampel'); ?></h4> 
            </div>

            <!--  DEBUG  -->
            <?php // include_once( plugin_dir_path( __FILE__ ) . 'assets/Energie-Ampel-Animation_yellow.php' ); ?>
            <?php include_once( plugin_dir_path( __FILE__ ) . 'assets/Energie-Ampel-Animation_'.$res['current']['color'].'.php' ); ?> 
        </div>

        <br><br>
       
        <div>
            <h3><?php _e('Die Energie Ampel erklärt', 'energie-ampel'); ?> </h3>
            <p><?php _e("Der Strom, den wir verbrauchen hat zu jeder Tages- und Nachtzeit einen unterschiedlich hohen CO2-Ausstoß. Je nachdem wie viel regional und regenerativ produzierter Strom gerade real im Netz fließt und wie hoch der gesamtstädtische Verbrauch ausfällt. Wird zum Beispiel gerade viel Windkraft aus Norddeutschland, Solarenergie aus dem Süden oder eigener Produktion geliefert, sinkt der gegenwärtige, reale CO2-Ausstoß. Die Wuppertaler Stadtwerke berechnen seit einigen Jahren diesen realen und stundengenauen CO2-Ausstoß hinter dem Strom, den wir verbrauchen. Zusammen mit der Bergischen Universität und dem Klimaquartier Arrenberg wurden diese Berechnungen in Raster übertragen und das hier sichtbare Energiewetter entwickelt. Es zeigt in den Phasen grün, gelb und rot in drei Stufen an, ob der CO2-Ausstoß jetzt gerade bzw. in den kommenden Stunden und Tagen hoch oder niedrig ist. Verlagerung statt Verzicht. Bestehende Geräte nutzen statt sofort neu kaufen zu müssen. Auf diesem Wege kann jeder Haushalt, unabhängig von den eigenen finanziellen Möglichkeiten an der Energiewende und dem Klimaschutz mitwirken. Das löst zwar noch nicht alle Probleme, ist aber ein smarter Schritt, den alle gehen können. ",'energie-ampel'); ?></p>
        </div>

        <br><br>

        <script>

            energieAmpel = false;   
            
            function show() {
                if (energieAmpel == false) {
                
                    var element = document.getElementById("overlay");
                    element.classList.remove("hidden");
                    element.classList.add("visible");

                    var htmlElement = document.getElementsByTagName("html")[0];
                    htmlElement.classList.add("no-scroll");

                    document.querySelector("a.energie-ampel-button").classList.add('is-primary');
                    energieAmpel = true;
                
                }
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