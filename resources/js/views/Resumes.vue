<style>
.list-group-item:hover {
    background-color: #f8f9fa !important;
}
.actionButton {
    height: 35px;
}
.actionButton {
    display: none;
}
.resumeItem:hover {
    background-color: #f8f9fa !important;
    .actionButton {
        display: flex;
    }
}
</style>

<template>
        <div class="container-xxl md-4 bg-white shadow p-4" style="min-height: calc(100vh - 86px);">
    <Modal
        title="Delete resume"
        save-text="Confirm"
        :submit-action="deleteResume"
        @trigger-submit-action="deleteResume"
        :close-on-submit="false"
        modal-id="deleteResume"
    >
        <h4>Are you sure you want to delete this resume?</h4>
    </Modal>

    <div class="py-4 px-4 mb-3">
        <div
            v-if="!store.getters.user"
            class="m-auto mt-5"
        >
            <div class="fs-2 fw-bold text-center">
                Please
                <router-link to="/login">Log in</router-link>
                to see your resumes
            </div>
        </div>
        <div
            v-else-if="resumeList.length < 1"
            class="m-auto mt-5"
        >
            <div class="fs-2 fw-bold text-center">
                No resumes saved yet.
                <router-link to="/resume">Create a resume</router-link>
            </div>
        </div>
        <div v-else>
            <div
                class="fs-3 ms-4 mb-2 fw-bold text-center"
                @mouseenter="hoverOverSection.overview = true"
                @mouseleave="hoverOverSection.overview = false"
            >
                Resume Overview
                <router-link
                    to="/"
                    class="btn addNew my-2"
                    :class="{ 'btn-secondary': hoverOverSection.overview }"
                >
                    <BsPlusCircle class="resumeIcon d-flex"/>
                </router-link>
            </div>

            <ul class="list-group list-group-flush position-relative p-4">
                <li
                    v-for="(resume, index) in resumeList"
                    class="resumeItem"
                >
                    <div
                        class="list-group-item border-0 py-3 d-flex"
                        :class="{ 'border-bottom': (index < (resumeList.length - 1) ) }"
                    >
                        <div>
                            <div>{{ resume.name }}</div>
                            <div class="text-secondary fst-italic small">{{ 'Updated at: ' + getDate(resume) }}</div>
                        </div>
                        <router-link
                            :to="{ name: 'resume', params: { id: resume.id } }"
                            class="btn btn-primary ms-auto mt-auto actionButton justify-content-center align-items-center flex-column"
                        >
                            Edit
                        </router-link>
                        <button
                            class="btn btn-outline-danger ms-2 mt-auto actionButton justify-content-center align-items-center flex-column"
                            @click="deleteResumePrompt(resume)"
                        >
                            Delete
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
        </div>
</template>

<script setup>
import {BsPlusCircle} from "@kalimahapps/vue-icons";
import axios from 'axios'
import store from '../store'
import {onMounted, ref} from 'vue';
import {createToaster} from '@meforma/vue-toaster'
import Modal from "../components/Modal.vue";
import router from "../router";

let deleteModalInstance

onMounted(() => {
    deleteModalInstance = new bootstrap.Modal('#deleteResume')
})

const successMessage = createToaster({ type: 'success', position: 'top' })
const errorMessage = createToaster({ type: 'error', position: 'top' })

const selectedResume = ref();
const resumeList = ref([]);
const hoverOverSection = ref({
    overview: false,
});

axios
    .get('api/resumes', [])
    .then((res) => {
        res.data.resumes = res.data.resumes.sort((a, b) => {
            return new Date(b.updated_at) - new Date(a.updated_at);
        })

        resumeList.value = res.data.resumes
    })
    .catch((err) => {
        if (err.response.data.errors) {
            for (const property in err.response.data.errors) {
                err.response.data.errors[property].forEach((error) => {
                    errorMessage.show(error)
                })
            }
        } else if (err.response.data.message) {
            errorMessage.show(err.response.data.message)
        }
    })

function getDate(resume) {
    return new Date(resume.updated_at).toLocaleDateString('en-US', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    })
}


function deleteResumePrompt(resume) {
    deleteModalInstance.toggle()
    selectedResume.value = resume
}

function deleteResume() {
    let resume = selectedResume.value
    axios.delete('/api/resume/' + resume.id)
        .then((res) => {
            let indexToRemove = resumeList.value.findIndex(item => item.id === resume.id);
            if (indexToRemove !== -1) {
                resumeList.value.splice(indexToRemove, 1);
            }
            successMessage.show(res.data.message)
        }).catch((err) => {
        if (err.response.data.errors) {
            for (const property in err.response.data.errors) {
                err.response.data.errors[property].forEach((error) => {
                    errorMessage.show(error)
                })
            }
        } else if (err.response.data.message) {
            errorMessage.show(err.response.data.message)
        }
    })
    deleteModalInstance.toggle()
}
</script>
