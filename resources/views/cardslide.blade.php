<div class="row">
    <div class="col-12">
        <div class="row mx-auto my-auto">
            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner" style="width: 95%;  margin-left: 2.5%" role="listbox">
                    <?php $i = 0;
                    foreach ($topic as $sl) : ?>
                    <?php
                        if ($i == 0) {
                            $set_ = 'active';
                        } else {
                            $set_ = '';
                        }
                        ?>
                    <div class="carousel-item <?php echo $set_; ?>">
                        <div class="col-md-4 mb-3 mt-3">
                            <div class="card h-100">
                                <a href="{{ asset('images/topic/cover/' . $sl->topic_images) }}" data-lity>
                                    <img class="card-img-top"
                                        src="{{ asset('images/topic/cover/' . $sl->topic_images) }}"
                                        alt="<?= $sl->topic_name ?>">
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <?= $sl->topic_name ?> <br>
                                    </h4>
                                    <h6 class="card-title">
                                        <?= $sl->couses->couses_name ?>
                                    </h6>
                                </div>
                                <div class="card-footer">
                                    <a class="btn text-white btn-success w-100"
                                        href="{{ url('/topic-page/' . $sl->id . '/') }}">รายละเอียด</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++;
                    endforeach ?>
                </div>

                <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle"
                        aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle"
                        aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    </div>


</div>