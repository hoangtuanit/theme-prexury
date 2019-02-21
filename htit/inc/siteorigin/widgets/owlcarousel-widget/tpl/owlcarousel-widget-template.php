<?php  

if( count( $instance['slides'] ) > 0 ):

  $slides = $instance['slides'];

  ?>
    <!-- Swiper -->
      <div class="owl-carousel owl-widget owl-theme">
        <?php
          foreach ( $slides as $key => $item ):

            $img_src = iz_get_thumbnail_src( $item['image'] );

            echo '<div class="item-slide">';


              if( !empty( $item['url'] ) )
                echo '<a href="'.sow_esc_url( $item['url'] ).'" > ';

              echo '<img src="'.$img_src.'" alt="'.$item['title'].'"/>';

              if( !empty( $item['url'] ) )
                echo ' </a>';

            echo '</div>';

          endforeach;
        ?>
      </div>

  <?php

endif;

?>