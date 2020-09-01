<?php 
/*
	$paginator->from()		// resultados fragmentados desde ...
	$paginator->to()		// restultados fragmentados hasta ...
	$paginator->total()		// el total de resultados (sin fragmentar)
	$paginator->page()		// pagina actual
	$paginator->pags()		// cantidad de paginas
	$paginator->link($v)	// helper constructor del enlace
    $paginator->xpag()
*/
?>

<div class="">

    <?php if(is_object($paginator) && $paginator->pags() > 1) : ?>

        <ul class="">
            <?php if($paginator->page() > '1') { ?>
                <li>
                    <a class="" href="<?=$paginator->link(1);?>">
                        <i class="fa fa-angle-double-left"></i>
                    </a>
                </li>
                <li>
                    <a class="" href="<?=$paginator->link($paginator->page()-1);?>">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
            <?php } ?>

                <?php
                // Set first
                if($paginator->page() > '7')
                    $i = $paginator->page() - 5;
                else
                    $i = 1;

                // Set last
                if( $paginator->pags() <= ( $paginator->page() +5 ))
                    $ultimo = $paginator->pags();
                else
                    $ultimo = $paginator->page() +5;
                ?>

                <?php for($i; $i <= $ultimo; $i++) { ?>
                    <li>
                        <a href="<?=$paginator->link($i)?>" class="<?=($paginator->page()==$i)?'active':'';?>">
                            <?=$i?>
                        </a>
                    </li>
                <?php } ?>

            <?php if($paginator->page() < $paginator->pags() ) { ?>
                <li>
                    <a class="" href="<?=$paginator->link($paginator->page()+1);?>">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <li>
                    <a class="" href="<?=$paginator->link($paginator->pags());?>">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php endif; ?>

    <div class="">
        <form action="<?=$paginator->link()?>" class="pager">
            <span>Resultados por Página: &nbsp;</span>
            <select name="xpag" onchange="submit()" data-width="65px" data-selected="<?=$paginator->xpag?>">
                <option value="10" <?=($paginator->xpag==10)?"selected":""?>>10</option>
                <option value="20" <?=($paginator->xpag==20)?"selected":""?>>20</option>
                <option value="30" <?=($paginator->xpag==30)?"selected":""?>>30</option>
                <option value="50" <?=($paginator->xpag==50)?"selected":""?>>50</option>
                <option value="100" <?=($paginator->xpag==100)?"selected":""?>>100</option>
            </select>
        </form>
    </div>
</div>