<div class="grid-container full ">
    <div class="grid-x screen-col">
        <div class="large-6 cell ">
            <?php
                if(isset($data['slider']['slot-0'])){                                     
                    echo $data['slider']['slot-0'];                    
                }
            ?>
      
        </div>
        <div class="large-6 cell">
            <?php
                if(isset($data['slider']['slot-1'])){                                     
                    echo $data['slider']['slot-1'];                    
                }
            ?>
         
        </div>
    </div>
    <hr class="hor-screendivide">
     <div class="grid-x screen-col">
        <div class="large-6 cell">
         <?php
                if(isset($data['slider']['slot-2'])){                                     
                    echo $data['slider']['slot-2'];                    
                }
            ?>
        </div>
        <div class="large-6 cell">
        <?php
                if(isset($data['slider']['slot-3'])){                                     
                    echo $data['slider']['slot-3'];                    
                }
            ?>
            
        </div>
    </div>
</div>

<?php
                    
                        // echo '<div class="grid-x grid-margin-x grid-margin-y">';
                       
                        // if($screen->getMode() == "four_divided") {


                        //     echo '<div class="cell large-6">';
                        //     echo '       <select name="screen[slot-0][]" class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" multiple>';
                            
                        //     echo '</select> </div>';
                        //     echo '   <div class="cell large-6">';
                        //     echo '       <select name="screen[slot-1][]" class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" multiple>';
                        //     if(isset($data['selected_packages']['slot-1'])){
                        //         foreach($selected_packages['slot-1'] as $key => $value){
                        //             echo '<option class="drag-element" id="'.$value->getId().'" value="'.$value->getId().'" draggable="true" ondragstart="drag(event)" width="336" height="69" selected>'.$value->getName().'</option>';
                        //         }
                        //     }
                        //     echo '  </select> </div>';
                        //     echo '   <div class="cell large-6">';
                        //     echo '       <select name="screen[slot-2][]" class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" multiple>';
                        //     if(isset($data['selected_packages']['slot-2'])){
                        //         foreach($selected_packages['slot-2'] as $key => $value){
                        //             echo '<option class="drag-element" id="'.$value->getId().'" value="'.$value->getId().'" draggable="true" ondragstart="drag(event)" width="336" height="69" selected>'.$value->getName().'</option>';
                        //         }
                        //     }
                        //     echo '</select>  </div>';
                        //     echo '  <div class="cell large-6">';
                        //     echo '      <select name="screen[slot-3][]" class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" multiple>';
                        //     if(isset($data['selected_packages']['slot-3'])){
                        //         foreach($selected_packages['slot-3'] as $key => $value){
                        //             echo '<option class="drag-element" id="'.$value->getId().'" value="'.$value->getId().'" draggable="true" ondragstart="drag(event)" width="336" height="69" selected>'.$value->getName().'</option>';
                        //         }
                        //     }
                        //     echo ' </select>  </div>';
                           
                        // }
                        // echo '</div>';
                        
                    ?>