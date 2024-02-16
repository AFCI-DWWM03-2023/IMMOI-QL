<?php ob_start(); ?>

<section class="content">
    <section class="testbdd">
        <h2>Mes Transactions</h2>
        <table>
            <tr>
                <th>Montant</th>
                <th>Date</th>
                <th>Acheteur</th>
                <th>Vendeur</th>
                <th>Bien concerné</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($transactionList !== NULL) :
            for ($i = 0; $i < count($transactionList); $i++) : ?>
                <tr>
                    <td><?= $transactionList[$i]->getMontant(); ?></td>
                    <td><?= $transactionList[$i]->getDate(); ?></td>
                    <td><?= $transactionList[$i]->getAcheteur(); ?></td>
                    <td><?= $transactionList[$i]->getVendeur(); ?></td>
                    <td><?= $transactionList[$i]->getBien(); ?></td>
                </tr>
            <?php endfor; endif;?>
        </table>
    </section>
</section>

<?php
$content = ob_get_clean();
$titre = "Mes transactions";
require "Views/template.php";
