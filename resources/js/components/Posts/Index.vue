<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const posts = ref([]);

// Fetch posts on mount
const fetchPosts = async () => {
    try {
        const response = await axios.get('/posts');
        posts.value = response.data;
    } catch (error) {
        console.error('Error fetching posts:', error);
    }
};

onMounted(fetchPosts);

// Update post status
const updateStatus = async (post, status) => {
    try {
        await axios.post(`/posts/${post.id}/status`, { status });
        post.status = status;
        alert('Status updated and email sent!');
    } catch (error) {
        console.error('Error updating status:', error);
    }
};

// Make a call
const makeCall = async (post) => {
    try {
        const response = await axios.get(`/posts/${post.id}/call`);
        alert(response.data.message);
    } catch (error) {
        console.error('Error making call:', error);
    }
};

// Update call status and save call result
const updateCallStatus = async (post) => {
    try {
        await axios.post(`/posts/${post.id}/call-status`, {
            call_done: post.call_done,
            call_result: post.call_done ? post.call_result : '',
        });
    } catch (error) {
        console.error('Error updating call status:', error);
    }
};
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Posts List</h1>
        <ul v-if="posts.length">
            <li v-for="post in posts" :key="post.id" class="border-b py-2">
                <h3 class="text-lg font-semibold">{{ post.title }}</h3>
                <p>{{ post.content }}</p>
                <p><strong>Status:</strong> {{ post.status }}</p>

                <!-- Status Dropdown -->
                <select @change="updateStatus(post, $event.target.value)" class="border rounded p-1">
                    <option value="pending" :selected="post.status === 'pending'">Pending</option>
                    <option value="approved" :selected="post.status === 'approved'">Approved</option>
                    <option value="rejected" :selected="post.status === 'rejected'">Rejected</option>
                </select>

                <!-- Call Button -->
                <button @click="makeCall(post)" class="ml-4 px-3 py-1 bg-blue-500 text-white rounded">
                    Call
                </button>

                <!-- Checkbox for Call Done -->
                <label class="block mt-2">
                    <input type="checkbox" v-model="post.call_done" @change="updateCallStatus(post)">
                    Call Done
                </label>

                <!-- Call Result Textarea -->
                <textarea
                    v-if="post.call_done"
                    v-model="post.call_result"
                    @input="updateCallStatus(post)"
                    placeholder="Enter call result..."
                    class="w-full mt-2 p-2 border rounded"
                ></textarea>
            </li>
        </ul>
        <p v-else>No posts found.</p>
    </div>
</template>
