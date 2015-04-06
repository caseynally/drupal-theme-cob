<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
?>
<header class="cob-siteHeader">
    <div class="cob-siteHeader-container">
        <nav>
        <?php
            foreach (taxonomy_get_tree(2, 0, 1) as $t) {
                echo l($t->name, 'taxonomy/term/'.$t->tid);
            }
        ?>
        </nav>
        <?php
            if (!empty($page['header_site'])) { echo render($page['header_site']); }
            if ($logo) {
                $t = t('Home');
                $alt_attribute = $site_name ? $site_name : $t;
                echo "
                <a href=\"$front_page\" class=\"cob-siteHeader-logo\" title=\"$t\" rel=\"home\" id=\"logo\">
                    <img src=\"$logo\" alt=\"$alt_attribute\" />
                </a>
                ";
            }
        ?>
    </div>
</header>