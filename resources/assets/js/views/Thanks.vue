<template>
    <div class="container-fluid">
        <div class="row">
            <div class="section__left col-xs-12 col-md-4 col-lg-3">
                <logo></logo>
                <div class="section__left__wrapper">
                    <h3>Jeżeli chcesz wyszukać aktualne konkursy i promocje jeszcze raz, cofnij się do poprzedniej strony.</h3>
                    <router-link to="/">
                        <button class="btn-1 btn">
                            Powrót
                        </button>
                    </router-link>

                    <!-- finished contests button -->
                    <div class="finished-btn">
                        <router-link to="/zakonczone">
                            <u>Zobacz zakończone konkursy</u>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="section__right col-xs-12 col-md-8 col-lg-9">
                <div class="section__right__title">
                    <h2>DZIĘKUJEMY</h2>
                </div>
                <div class="wrapper thanks">
                    <h2>Dziękujemy za zgłoszenie!</h2>
                    <br>
                    <router-link to="/">
                        <button type="button" name="button" class="btn btn-1">Wróć do strony głównej</button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        }
    }
</script>
