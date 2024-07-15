<template lang="">
    <div class="w-96 mx-auto">
        <div class="mt-2.5">
          <input v-model="title" type="text" class="w-96 p-1 mb-2 border border-inherit rounded-lg" placeholder="title">
        </div>

        <div class="mt-2.5">
          <textarea v-model="content" rows="4" class="w-96 p-1 mb-2 border border-inherit rounded-lg" placeholder="content"></textarea>
        </div>

        <div>
            <input class="block float-right mx-auto w-32 p-1 bg-sky-400 text-white rounded-lg" type="submit" value="Publish">
        </div>
    </div>
</template>

<script>
export default {

    name: 'Personal',

    data() {
        return {
            title: null,
            contain: null
        }
    },

}
</script>

<style lang="">

</style>
