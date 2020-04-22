@include('coronamv.resources.partials.header')

<body>
    
    <main role="main" id="app">


        <section class="jumbotron text-center">
            <div class="container">
                <a href="/resources"><img class="img-fluid img-thumbnail mb-2" style="border: 0px;" src="/images/coronaresource.png"></a>
                <hr>
                <div class="alert element-background" style="color:white;" role="alert">
                    Looking for Delivery Services? Head over to <a href="https://baazaaru.mv/" target="_blank" class="alert-link">Baazaaru.mv</a>
                   </div>
                <p class="lead">A curated list of services offered by maldivian companies to help with the
                    COVID-19 crisis. Home Delivery, Free Services and more</p>
                   
                <p>
                    
                    <a href="#" class="btn button-primary" @click.prevent="filter(filterkey.sub)"
                        v-for="filterkey in filter_set">#@{{filterkey.name}}</a>


                </p>



            </div>

        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">

                    <div class="col-md-4" v-for="resource in resources">
                        <div class="card mb-4 box-shadow">
                            <div class="thumbnail">
                                <img class="card-img-top" :src="'/images/resources/' + resource.image"
                                    alt="Card image cap">
                            </div>

                            <div class="card-body">

                                <h4 class="font-weight-bold">@{{resource.title}}</h4>
                                <p class="card-text">@{{resource.body}}</p>

                                <div>
                                    <p class="font-weight-bold contact">Contact: <a style="color: #5676F7;"
                                            :href="'tel:+(960)' + resource.contact" target="_blank">
                                            +(960) @{{resource.contact}}
                                        </a></p>

                                    <p class="text-left" style="color:#5676F7;">#@{{resource.resource_tag}}</p>

                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">

                                        <a class="btn btn-sm button-primary-sm" target="_blank" :href="resource.resource_link">Visit</a>

                                    </div>

                                    <small class="text-muted">@@{{resource.creator}}</small>


                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>

    </main>

    @include('coronamv.resources.partials.footer')



</body>

</html>