<template>
	<div class="container-fluid">
        <div class="row">
            <div class="section__left col-xs-12 col-md-4 col-lg-3">
                <logo></logo>
                <div class="section__left__wrapper hidden-sm hidden-xs">
                    <h3 class="hidden-xs hidden-sm">Jeżeli chcesz wyszukać aktualne konkursy i promocje jeszcze raz, cofnij się do poprzedniej strony.</h3>
                    <router-link to="/" class="hidden-xs hidden-sm">
                        <button class="btn-1 btn">
                            Powrót
                        </button>
                    </router-link>
                </div>
                <!-- finished contests button -->
                <div class="finished-btn" >
                    <router-link to="/zakonczone">
                        Zobacz zakończone konkursy
                    </router-link>
                </div>
            </div>
            <div class="section__right col-xs-12 col-md-8 col-lg-9">
                <div class="section__right__title hidden-xs hidden-sm">
                    <h2 v-if="contest.countrywide">KONKURS OGÓLNOPOLSKI</h2>
                    <h2 v-if="!contest.countrywide">KONKURS LOKALNY</h2>
                </div>
                <div class="contest-single wrapper">
                    <div class="contest-single__banner">
                        <div class="contest-single__banner__claim"></div>
                        <div class="contest-single__banner__packshot-1 hidden-xs">
                            <img src="/images/packshot-left.png" alt="packshot" class="img img-responsive">
                        </div>
                        <div class="contest-single__banner__packshot-2 hidden-xs">
                            <img src="/images/packshot-right.png" alt="packshot" class="img img-responsive">
                        </div>
                    </div>
					<div class="ribbon hidden-xs" v-if="contest.countrywide"></div>
					<div class="ribbon-reg hidden-xs" v-if="!contest.countrywide"></div>
                    <div class="contests__list__contest">
                        <div class="contests__list__contest__logo">
                            <img class="img img-responsive" :src="'/storage/' + contest.logo" alt="">
                        </div>
                        <div v-if="!contest.countrywide" class="contests__list__contest__desc">
                            <h4>{{ contest.shop_name }}, {{ contest.shop_city }}, ul. {{ contest.shop_address }}</h4>
                            <p>Konkurs trwa od <span>{{ contest.date_start }}</span> do <span>{{ contest.date_end }}</span></p>

                        </div>
                        <div v-if="contest.countrywide" class="contests__list__contest__desc">
                            <h4>{{ contest.shop_name }}</h4>
                            <p>Konkurs trwa od <span>{{ contest.date_start }}</span> do <span>{{ contest.date_end }}</span></p>
							<modalshops v-if="contest.shops" :show.sync="showModal" :item="contest" :active.sync="active" @handleModalClose="handleModalClose"></modalshops>
							<div v-if="contest.shops" class="contests__list__contest__shops-btn contests__list__contest__shops-btn--single" @click="modalOpen(contest.id)">Zobacz sklepy</div>
                        </div>
                    </div>
                    <div class="contest-single__prize" v-if="contest.prize">
                        <img class="img img-responsive" :src="'/storage/' + contest.prize" alt="">
                    </div>
                    <div v-if="contest.is_text" class="contest-single__question">
                        <h2>{{ contest.question }}</h2>
						<p v-if="(contest.is_file && contest.is_text)">* wybierz 1 ze sposobów odpowiedzi</p>
                    </div>

                    <!--=============================================>>>>>
                    = Contest form =
                    ===============================================>>>>-->
                    <div class="contest-form">
                        <form @submit.prevent="handleEntry" class="form-horizontal">
                            <fieldset>
                                <div class="col-sm-12"><!-- Textarea -->
                                    <div class="form-group" v-if="contest.is_text" :class="{'form-group--error': errors.has('entry.text') }">
                                        <div class="col-sm-12">
                                            <textarea v-validate="`${entry.file ? '' : 'required'}`" v-model="entry.text" name="entry.text" id="" cols="30" rows="3" class="form-control" placeholder="Tutaj wpisz swoją odpowiedź"></textarea>
                                            <p class="text-danger" v-if="errors.has('entry.text')">{{ errors.first('entry.text') }}</p>
                                        </div>
                                    </div>
									<p v-if="(contest.is_file && contest.is_text)" class="form-or">lub</p>
                                    <div class="col-sm-12" v-if="contest.is_file">
                                        <div class="form-group fileupload">
                                            <input id="entry.file" v-validate="'size:5120'" type="file" name="entry.file" v-on:change="changeFile">
                                            <label class="file btn btn-1" for="entry.file">{{ filename }}</label>
                                            <p class="text-danger" v-if="errors.has('entry.file')">{{ errors.first('entry.file') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 form-left">
                                        <div class="form-group" :class="{'form-group--error': errors.has('entry.name') }">
                                            <input name="entry.name" v-validate="'required'" type="text" class="form-control" placeholder="Imię i Nazwisko" v-model="entry.name">
                                            <p class="text-danger" v-if="errors.has('entry.name')">{{ errors.first('entry.name') }}</p>
                                        </div>
                                        <div class="form-group" :class="{'form-group--error': errors.has('entry.email') }">
                                            <input name="entry.email" v-validate="'required|email'" type="text" class="form-control" placeholder="Adres e-mail" v-model="entry.email">
                                            <p class="text-danger" v-if="errors.has('entry.email')">{{ errors.first('entry.email') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 form-right">
                                        <div class="form-group" :class="{'form-group--error': errors.has('entry.phone') }">
                                            <input name="entry.phone" maxlength="9" v-validate="'digits:9'" type="text" class="form-control" placeholder="Telefon" v-model="entry.phone">
                                            <p class="text-danger" v-if="errors.has('entry.phone')">{{ errors.first('entry.phone') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <select name="entry.survey" v-model="entry.survey" class="form-control">
                                                <option selected value="brak odpowiedzi">Skąd dowiedziałeś się o konkursie</option>
                                                <option value="z profilu social media BEAUTY RAZORS">Z profilu social media BEAUTY RAZORS</option>
                                                <option value="z plakatu w sklepie">Z plakatu w sklepie</option>
                                                <option value="od znajomej/znajomego">Od znajomej/znajomego</option>
                                                <option value="inne">Inne</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="entry.perm1" v-model="entry.perm1" v-validate="'required'">
                                                    <p>Tak, biorę udział w konkursie<span> *</span></p>
													<p class="text-danger" v-if="errors.has('entry.perm1')">{{ errors.first('entry.perm1') }}</p>
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="entry.perm2" v-model="entry.perm2" v-validate="'required'">
                                                    <p>Zapoznałem się i akceptuje warunki <a target="_blank" :href="'/storage/' + contest.rules">regulaminu</a><span> *</span></p>
													<p class="text-danger" v-if="errors.has('entry.perm2')">{{ errors.first('entry.perm2') }}</p>
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="entry.perm3" v-model="entry.perm3" v-validate="'required'">
                                                    <p>lorem20<span> *</span></p>
													<p class="text-danger" v-if="errors.has('entry.perm3')">{{ errors.first('entry.perm3') }}</p>
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="entry.perm4" v-model="entry.perm4" v-validate="'required'">
                                                    <p>asdasdf<span> *</span></p>
													<p class="text-danger" v-if="errors.has('entry.perm4')">{{ errors.first('entry.perm4') }}</p>
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="entry.perm5" v-model="entry.perm5" v-validate="'required'">
                                                    <p>Oświadczam, iż zapoznałem/łam się z <a href="/assets/downloads/regulamin.pdf" target="_blank">Regulaminem Serwisu</a> oraz <a href="/assets/downloads/polityka_prywatnosci.pdf" target="_blank">Polityką prywatności</a> i akceptuję wszystkie ich postanowienia<span> *</span></p>
													<p class="text-danger" v-if="errors.has('entry.perm5')">{{ errors.first('entry.perm5') }}</p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-btn col-sm-12">
                                        <button ref="submit" type="submit" class="btn-1 btn">Wyślij</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!--= End of Contest form =*/-->
                    <!--=============================================<<<<<-->
                </div>
                <!-- <div class="footer-text">
                    Regulamin konkursu dostępny jest w siedzibie Truly (ul. Domaniewska 45, 02-672 Warszawa) oraz w sklepach  biorących udział w konkursie.
                </div> -->
				<footer-rodo></footer-rodo>
            </div>
        </div>
    </div>
</template>

<script>
    import router from '../routes';
	export default {
        data() {
        	return {
                filename: 'Dodaj zdjęcie',
                contest: {},
				showModal: false,
				active: 0,
                entry: {
                    file: '',
                    contest_id: 0,
                    name: '',
                    email: '',
                    phone: '',
                    text: '',
                    survey: 'brak odpowiedzi',
                    perm1: false,
                    perm2: false,
                    perm3: false
                }
        	}
        },
        created() {
            this.$validator.localize('pl', {
                messages:{
                    required: () => 'To pole jest wymagane.',
                    email: () => 'Wprowadź poprawny adres email',
                    digits: () => 'Telefon musi mieć 9 cyfr.',
                    size: () => 'Plik musi być mniejszy niż 5MB.'
                }
            });
            this.$validator.localize('pl');

            axios.get('/api/contests/' + this.$route.params.id)
                .then(res => {
                    if (res.data) {
                        this.contest = res.data;
                        this.entry.contest_id = this.contest.id;
                        var rules = JSON.parse(this.contest.rules);
                        this.contest.rules = rules[0].download_link;

                    }
                })
                .catch(res => {
                    console.error(res);
                    router.push('/');
                });
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
            handleEntry() {
                this.$refs.submit.disabled = true;
                document.getElementsByTagName("BODY")[0].classList.add('progress');
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post('/api/entries', this.entry)
                            .then(res => {
                                router.push('/dziekujemy');
                                document.getElementsByTagName("BODY")[0].classList.remove('progress');
                            })
                            .catch(res => { console.error(res) })
                    } else {
                        this.$refs.submit.disabled = false;
                        document.getElementsByTagName("BODY")[0].classList.remove('progress');
                        document.querySelector('input[name="' + this.errors.items[0].field + '"], textarea[name="' + this.errors.items[0].field + '"]').scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            },
            changeFile(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length) {
                    return;
                }
                this.filename = files[0].name;
                this.createFile(files[0]);
            },
            createFile(file) {
                var reader = new FileReader();
                var vm = this;
                reader.onload = (e) => {
                    vm.entry.file = e.target.result;
                    vm.entry.filetype = vm.filename.split('.').pop();
                };
                reader.readAsDataURL(file);
            },
        }
	}
</script>
