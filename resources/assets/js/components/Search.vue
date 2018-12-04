<template>
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
</template>
    <script>
    	export default {
            data() {

            }
    	}
    </script>
