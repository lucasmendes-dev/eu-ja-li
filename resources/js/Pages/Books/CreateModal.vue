<script setup>
import { defineProps, defineEmits } from "vue";

import CreateEditForm from './CreateEditForm.vue';

defineProps({
  isOpen: Boolean,
  allBooks: Object
});

const emit = defineEmits(["close"]);

function handleClose() {
  emit('close');
}

</script>

<template>
  <div v-if="isOpen" class="modal-overlay" @click.self="handleClose">
    <div class="modal-content">
      <header>
        <h2 class="font-bold">Adicionar Livro</h2>
        <button @click="handleClose" class="close-btn mr-4 mt-2">X</button>
      </header>
      <div>
        <CreateEditForm :allBooks="allBooks" @close="handleClose" />
      </div>
    </div>
  </div>
</template>


<style scoped>

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal-content {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  position: relative;
  max-width: 500px;
  width: 100%;
}

.close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  border: none;
  background: transparent;
  font-size: 1.2rem;
  cursor: pointer;
}
</style>
