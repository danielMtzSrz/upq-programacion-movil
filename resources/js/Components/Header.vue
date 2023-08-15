<script setup>
// Componentes de Vue
import { Inertia } from "@inertiajs/inertia";

// Componentes de primevue
import Button from "primevue/button";
import Menubar from "primevue/menubar";
import UserMenu from "@/Components/UserMenu.vue";
import Avatar from 'primevue/avatar'

// Layouts
import Sidebar from "@/Layouts/Sidebar.vue";

const props = defineProps({
    title: String,
    darkMode: {
        type: Boolean,
        default: null,
    },
    titleModule: String
});

const emits = defineEmits(["themeColor"]);

const logout = () => {
    Inertia.post(route("logout"));
};
</script>

<template>
    <div class="d-flex">
        <Menubar :model="items" class="container-fluid">
            <template #start>
                <div class="d-flex">
                    <!-- <Sidebar :items="items"/> -->
                    <span class="mx-2 my-0 py-0 text-2xl font-light" style="font-family: Roboto, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol;">{{ title ?? "Bienvenido" }}</span>
                </div>
            </template>
            <template #end>
                <div class="d-flex align-items-center">
                    <Button
                        :icon="darkMode == true ? 'pi pi-moon' : 'pi pi-sun'"
                        class="p-button-rounded"
                        :class="
                            darkMode == true
                                ? 'p-button-text p-button-help'
                                : 'p-button-warning p-button-outlined'
                        "
                        id="darkModeId"
                        name="darkModeId"
                        @click="emits('themeColor')"
                    />
                    <user-menu></user-menu>
                </div>
            </template>
        </Menubar>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [
                {
                    label: "Usuarios",
                    icon: "pi pi-users",
                    command: () => {
                        Inertia.visit(route("user.index"));
                    },
                },
                {
                    label: "Roles",
                    icon: "pi pi-key",
                    command: () => {
                        Inertia.visit(route("role.index"));
                    },
                },
                {
                    label: "Permisos",
                    icon: "pi pi-unlock",
                    command: () => {
                        Inertia.visit(route("permission.index"));
                    },
                },
                {
                    label: "Eventos",
                    icon: "pi pi-calendar",
                    command: () => {
                        Inertia.visit(route("eventos.index"));
                    },
                },
            ],
        };
    },
};
</script>
