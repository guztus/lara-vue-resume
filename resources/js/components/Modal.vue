<template>
    <div class="modal fade" :id="modalId" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1
                        class="modal-title fs-5"
                        id="exampleModalLabel"
                    >
                        {{ title }}
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <slot/>
                </div>
                <div class="modal-footer">
                    <button
                        v-if="showDeleteButton"
                        type="button"
                        class="btn btn-danger me-auto"
                        data-bs-dismiss="modal"
                        @click="deleteAction()"
                    >
                        Delete</button>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>
                    <button
                        v-if="closeOnSubmit"
                        type="button"
                        class="btn btn-primary"
                        data-bs-dismiss="modal"
                        @click="submitAction()"
                    >
                        {{ saveText ?? 'Save changes' }}</button>
                    <button
                        v-else type="button"
                        class="btn btn-primary"
                        @click="submitAction()"
                    >
                        {{ saveText ?? 'Save changes' }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps([
    'modalId',
    'title',
    'saveText',
    'showDeleteButton',
    'closeOnSubmit'
]);

const emit = defineEmits(['trigger-submit-action', 'trigger-delete-action']);

function submitAction() {
    emit('trigger-submit-action')
}
function deleteAction() {
    emit('trigger-delete-action')
}
</script>
