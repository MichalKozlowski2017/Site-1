<template>
    <transition name="modal">
    <div v-if="modalActiveContent(item.id)" class="modal-mask" v-show="show" aria-hidden="true" role="dialog" @click="setModalClose">


                <div class="modal-container contests__list__shops">
                    <h4>{{ item.name }}</h4>
                    <div v-bar="{
                    preventParentScroll: true,
                    scrollThrottle: 30
                    }"> <!-- el1 -->
                        <div> <!-- el2 -->
                            <ul>
                                <li v-for="shop in item.shops.split('\r\n')">
                                {{shop}}
                                </li>
                            </ul>
                        </div>
                        <!-- dragger will be automatically added here -->
                    </div>
                    <div>

                    </div>

                    <button @click="setModalClose" v-if="modalActiveContent(item.id)" @handleModalClose="setModalClose">
                    </button>
                </div>
            </div>
    </div>
    </transition>
</template>

<script>

    export default {
        props: {
        item: {},
        active: 0,
        show: {
            type: Boolean,
            required: true,
            twoWay: true
            }
        },
        methods: {
            // check wich content index is active
            modalActiveContent: function(i) {
                return this.active === i
            },
            // close modal
            setModalClose: function(event) {
                this.$emit('handleModalClose', false)
            }
        }
    }
</script>
