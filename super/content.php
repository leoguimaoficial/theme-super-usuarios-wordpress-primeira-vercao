<?php
/**
* The default template for displaying content
*
* Used for both single and index/archive/search.
*
* @package WordPress
* @subpackage Twenty_Twelve
* @since Twenty Twelve 1.0
*/
?>

<div class="col-12 col-md-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <a href="<?php echo get_permalink(get_the_ID()); ?>">
            <div class="thumbnail row">
                <div class="col-md-4">
                    
                    <?php
                    if (has_post_thumbnail()) {
                        echo '<figure>';
                            the_post_thumbnail('thumbnail', array('alt' => get_the_title(), 'class' => 'img-responsive img-post img-thumbnail'));
                            echo '</figure>';
                        } else {
                            echo '<figure>';
                                echo '<img src="'.img_url('placeholder.png').'" alt="Image placeholder" class="img-fluid">';
                                echo '</figure>';
                            }
                            ?>
                        </div>
                        <div class="col-md-8">
                            <div class="text pt-2">
                                <?php echo '<h6>' . get_the_title(get_the_ID()) . '</h6>'; ?>
                                <?php echo '<p>'.mb_strimwidth(get_the_excerpt(), 0,76, ' »')  . '</p>'; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </article><!-- #post -->
        </div>