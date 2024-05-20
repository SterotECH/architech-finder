@resource('layouts/master')
@component("resources/views/components/header.cmp.php");
<div class="my-36 mx-10">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-8">

        <?php foreach ($architects as $architect) : ?>

            <div class="card w-96 bg-base-100 shadow-xl">
                <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="<?= $architect['first_name'] . ' ' . $architect['last_name']; ?>" /></figure>
                <div class="card-body">
                    <h2 class="card-title">
                        <?= $architect['first_name'] . ' ' . $architect['last_name']; ?>
                        <div class="badge badge-secondary"> <?= $architect['years_of_experience']; ?> Years Experience</div>
                    </h2>
                    <p><?= $architect['speciality']; ?></p>
                    <div class="card-actions justify-end">
                        <div class="badge badge-outline">Fashion</div>
                        <div class="badge badge-outline">Products</div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>