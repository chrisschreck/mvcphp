<?php
$modeGerman = array(
    'four_divided' => 'geviertelt',
    'one_screen' => 'vollbild');  
?>
<section class="grid-container">
<div class="grid-x grid-margin-x">
        <div class="cell">
            <h4>Editieren des Bildschrims: <?php echo $screen->getName()?></h4>
            <hr>
        </div>
        <div class="cell large-4">
            <a href="/screen"><button class="button">Zurück zur Bildschirm-Übersicht</button></a>
        </div>
    </div>
    <hr>
    <?php echo (isset($data['message']) ? $data['message'] : ''); ?>
    <div class="grid-x grid-margin-x">
        <div class="cell large-8">
            <div class="content">
                <form method="POST">
                    <label class="form-label required">Name des Bildschrims:</label>
                    <input type="text" name="screen_name" placeholder="Screenname" value="<?php echo $screen->getName()?>" required>
                    <label class="form-label required">Aktuelle Aufteilung:</label>
                    <select name="mode">
                        <option value=""> - Bitte Aufteilung wählen - </option>
                        <?php

                          
                            foreach(\app\config\Settings::SCREEN_MODE_TYPES as $mode_name) {
                                if($mode_name == $screen->getMode()) {
                                    echo "<option selected value='$mode_name'>".(isset($modeGerman[$mode_name]) ? $modeGerman[$mode_name] : $mode_name)."</option>";
                                } else {
                                    echo "<option value='$mode_name'>".(isset($modeGerman[$mode_name]) ? $modeGerman[$mode_name] : $mode_name)."</option>";
                                }
                            }
                        ?>
                    </select>
                    <?php
                    
                        echo '<div class="grid-x screen-split-margin">';
                       
                        if($screen->getMode() == "four_divided") {
                            echo '<div class="cell large-6 screen-split"><div class="screen-background">Bereich 1</div>';
                            echo '       <div name="screen[slot-0][]" class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" multiple>';
                            if(isset($data['selected_packages']['slot-0'])){
                                foreach($selected_packages['slot-0'] as $key => $value){
                                    echo '<div class="drag-element" data-name="screen[slot-0]" id="'.$value->getId().'" value="'.$value->getId().'" draggable="true" ondragstart="drag(event)" width="336" height="69" selected>'.$value->getName().'</div><label></label>';
                                }
                            }
                            echo '</div> </div>';
                            echo '   <div class="cell large-6 screen-split"><div class="screen-background">Bereich 2</div>';
                            echo '       <div name="screen[slot-1][]" class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" multiple>';
                            if(isset($data['selected_packages']['slot-1'])){
                                foreach($selected_packages['slot-1'] as $key => $value){
                                    echo '<div class="drag-element" data-name="screen[slot-1]" id="'.$value->getId().'" value="'.$value->getId().'" draggable="true" ondragstart="drag(event)" width="336" height="69" selected>'.$value->getName().'</div>';
                                }
                            }
                            echo '  </div> </div>';
                            echo '   <div class="cell large-6 screen-split"><div class="screen-background">Bereich 3</div>';
                            echo '       <div name="screen[slot-2][]" class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" multiple>';
                            if(isset($data['selected_packages']['slot-2'])){
                                foreach($selected_packages['slot-2'] as $key => $value){
                                    echo '<div class="drag-element" data-name="screen[slot-2]" id="'.$value->getId().'" value="'.$value->getId().'" draggable="true" ondragstart="drag(event)" width="336" height="69" selected>'.$value->getName().'</div>';
                                }
                            }
                            echo '</div>  </div>';
                            echo '  <div class="cell large-6 screen-split"><div class="screen-background">Bereich 4</div>';
                            echo '      <div name="screen[slot-3][]" class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" multiple>';
                            if(isset($data['selected_packages']['slot-3'])){
                                foreach($selected_packages['slot-3'] as $key => $value){
                                    echo '<div class="drag-element" data-name="screen[slot-3]" id="'.$value->getId().'" value="'.$value->getId().'" draggable="true" ondragstart="drag(event)" width="336" height="69" selected>'.$value->getName().'</div>';
                                }
                            }
                            echo ' </div></div>';
                        }
                        echo '</div>';
                        
                    ?>
                      <input type="submit" name="save" id="save-screen" class="submit-button" value="Speichern" style="margin-top: 30px;">
                      <div id="inputs"></div>
                </form>
            </div>
        </div>
        <?php
            echo '<div class="cell large-4 available-packages">';
            echo "<h4>Verfügbare Packages</h4><br><p> Einfach per Drag and Drop in die gewünschten Bereiche ziehen</p>";
            foreach($data["packages"] as $value) {
                echo '<div class="drag-element" id="'.$value->getId().'" value="'.$value->getId().'" draggable="true" ondragstart="drag(event)" width="336" height="69">'.$value->getName().'</div>';
            }
            echo '</div>';
            echo '<hr>';
        ?>
    </div>
    
    <style>
        .div1 {
            width: 100%;
            height: 150px;
            padding: 10px;
            border: 1px solid #aaaaaa;
        }

        .screen-split {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
            document.getElementById(data).setAttribute('selected', 'selected');
            var value = document.getElementById(data).getAttribute('value');
            var name = document.getElementById(data).parentNode.getAttribute("name");
            //console.log(document.getElementsByClassName( "input" ));
            //var childsinput = $( "#inputs" ).children();
            $('<input>', {
                type: 'hidden',
                id: 'foo',
                name: name,
                value: value
            }).appendTo( "#inputs" );
            var inputs = document.getElementById("#inputs").querySelectorAll("*");
            console.log(inputs);

            
        }
    </script>

    
</section>

<?php

var_dump($_POST);