<div class="container mt-2">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo bloginfo('url'); ?>"><?php echo bloginfo('name'); ?></a></li>
				
						<?php if(is_single()): ?>
                        <li class="breadcrumb-item active">
							<?php echo get_the_title(get_the_ID()); ?>
						</li>
						<?php endif; ?>
						<?php if(!is_single() && !isset($_GET['s'])): ?>
							<?php $term_title = termSlugToTitle(); ?>
								<?php if($term_title): ?>
									<li class="breadcrumb-item active">
										<?php echo $term_title; ?>
									</li>						
								<?php endif; ?>
						<?php endif; ?>
                </ol>
        </div>