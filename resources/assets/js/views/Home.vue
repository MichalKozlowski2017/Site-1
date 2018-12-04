<template>
	<div class="container-fluid home">
        <div class="row">
            <div class="section__left col-xs-12 col-md-4 col-lg-3">
                <logo></logo>
                <div class="section__left__wrapper">
                    <div class="section__left__wrapper__title">
                        <h2>Weź udział w aktualnych konkursach!</h2>
                    </div>
                    <form class="search-input-wrapper">
                        <div class="hint-module">
                            <div class="hint-module__list">
                                <div class="hint-module__list__elem">
                                    <a href="#contests" @click.prevent="handleHint('Super-Pharm')">
                                        <img class="img img-responsive" src="/images/hint-1.png" alt="">
                                    </a>
                                </div>
                                <div class="hint-module__list__elem">
                                    <a href="#contests" @click.prevent="handleHint('Carrefour')">
                                        <img class="img img-responsive" src="/images/hint-2.png" alt="">
                                    </a>
                                </div>
                                <div class="hint-module__list__elem">
                                    <a href="#contests" @click.prevent="handleHint('Kaufland')">
                                        <img class="img img-responsive" src="/images/hint-3.png" alt="">
                                    </a>
                                </div>
                                <div class="hint-module__list__elem">
                                    <a href="#contests" @click.prevent="handleHint('Auchan')">
                                        <img class="img img-responsive" src="/images/hint-4.png" alt="">
                                    </a>
                                </div>
                                <div class="hint-module__list__elem">
                                    <a href="#contests" @click.prevent="handleHint('Intermarche')">
                                        <img class="img img-responsive" src="/images/hint-5.png" alt="">
                                    </a>
                                </div>
                                <div class="hint-module__list__elem">
                                    <a href="#contests" @click.prevent="handleHint('E.Leclerc')">
                                        <img class="img img-responsive" src="/images/hint-6.png" alt="">
                                    </a>
                                </div>
                                <div class="hint-module__list__elem">
                                    <a href="#contests" @click.prevent="handleHint('Natura')">
                                        <img class="img img-responsive" src="/images/hint-7.png" alt="">
                                    </a>
                                </div>
                                <div class="hint-module__list__elem">
                                    <a href="#contests" @click.prevent="handleHint('Hebe')">
                                        <img class="img img-responsive" src="/images/hint-8.png" alt="">
                                    </a>
                                </div>
                                <div class="hint-module__list__elem">
                                    <a href="#contests" @click.prevent="handleHint('Frisco')">
                                        <img class="img img-responsive" src="/images/hint-9.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <h3>lub wyszukaj:</h3>
                        </div>
                        <div>
                            <input @keydown="handleSearch" ref="search" type="search" id="search" v-model="search" name="search" class="search-input" placeholder="Wpisz adres sklepu (miasto, ulica lub nazwa)">
                            <p id="clearInput" @click.prevent="handleHint('')" class="hidden-xs hidden-sm">Wyczyść</p>
                        </div>
                        <div class="btn-search">
                            <!-- <a @click="scrollMeTo('porto')"> -->
                            <a href="#contests">
                                <button type="button" name="button" class="btn btn-1">Wyszukaj</button>
                            </a>
                        </div>
                    </form>

                    <finishedbtn></finishedbtn>
                </div>

            </div>


            <div class="section__right col-xs-12 col-md-8 col-lg-9" ref="porto" >
                <div class="section__right__kv">
                    <div class="section__right__kv__claim">

                    </div>
                    <div class="section__right__kv__icon">

                    </div>
                </div>
                <div class="section__right__title">
                    <h2>Aktualne Konkursy</h2>
                </div>
                <div class="contests" >

                    <div class="contests__list ogolne">
                        <h3>Konkursy ogólnopolskie</h3>
						<div v-for="item in global" v-bind:key="item.id" class="contests__list__wrapper wrapper-ogolnopolskie">
							<modalshops v-if="item.shops" :show.sync="showModal" :item="item" :active.sync="active" @handleModalClose="handleModalClose"></modalshops>
							<div v-if="item.shops" class="contests__list__contest__shops-btn" @click="modalOpen(item.id)">Zobacz sklepy</div>
	                        <router-link :to="'/konkurs/' + item.id" >
	                        	<div class="contests__list__contest wrapper ">
	                                <div class="contests__list__contest__logo">
	                                    <img class="img img-responsive" :src="'/storage/' + item.logo" alt="">
	                                </div>
	                                <div class="contests__list__contest__desc">
	                                    <h4>{{ item.shop_name }}</h4>
	                                    <p>Konkurs trwa od <br class="visible-xs"><span>{{ item.date_start }}</span> do <span>{{ item.date_end }}</span></p>
	                                </div>
	                            </div>
	                        </router-link>
						</div>
						<div class="no-contests" v-if="!global.length">Brak wyników do wyświetlenia</div>
                    </div>
					<div class="contests__list regionalne" id="contests">
                        <h3>Konkursy lokalne</h3>
                        <router-link :to="'/konkurs/' + item.id" v-for="item in filteredLocal" v-bind:key="item.id">
                        	<div class="contests__list__contest wrapper wrapper-regionalne">
                                <div class="contests__list__contest__logo">
                                    <img class="img img-responsive" :src="'/storage/' + item.logo"  alt="">

                                </div>
                                <div class="contests__list__contest__desc">
                                    <h4>{{ item.shop_name }}, {{ item.shop_city }}, ul. {{ item.shop_address }}</h4>
                                    <p>Konkurs trwa od <br class="visible-xs"><span>{{ item.date_start }}</span> do <span>{{ item.date_end }}</span></p>
                                </div>
                            </div>
                        </router-link>
                        <div class="no-contests" v-if="!filteredLocal.length">Brak wyników do wyświetlenia</div>
                    </div>
                </div>
				<footer-rodo></footer-rodo>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
        data() {
        	return {
        		local: [],
        		global: [],
                search: null,
				showModal: false,
				active: 0
        	}
        },
        created() {
        	axios.get('/api/contests')
        		.then(res => {
        			this.local = res.data.local;
        			this.global = res.data.global;
        		})
        		.catch(res => console.error(res));
        },
        computed: {
            filteredLocal() {
                let items = this.local;
                if (!this.search) return items;
                let searchValue = this.search.toLowerCase().replace(/-|\s/g, "");
                let filter = contest => {
                    var comparedValue = contest.shop_name + ' ' + contest.shop_city + ' ' + contest.shop_address;
                    comparedValue = comparedValue.replace(/-|\s/g, "");
                    return comparedValue.toLowerCase().includes(searchValue);
                }

                return items.filter(filter)
            }
        },
		updated() {
			$('a[href^="#"]').click(function(){

				var the_id = $(this).attr("href");
				    $('html').animate({
				        scrollTop:$(the_id).offset().top
				    }, 180);
			return false;});
		},
        methods: {
		modalOpen: function(i) {
	        this.showModal = true;
			return this.active = i;
		},
		handleModalClose(value) {
			this.showModal = false;
			this.active = 0;
		},
		handleHint(hint) {
			this.search = hint;
		},
  		handleSearch(event) {
  			if(event.keyCode == 13) {
  				event.preventDefault();
  				return false;
  			}
  		},
		confirm: function(e) {
	        if ( ! window.confirm('Are you sure?')) {
	          e.preventDefault()
	        }
	        // else continue to route
	    }
	}
}
</script>
