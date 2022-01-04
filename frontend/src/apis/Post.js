import Api from "./Api";
import Csrf from "./Csrf";

export default {
    async all($id) {
        await Csrf.getCookie();

        return Api.get("/posts", $id);
    },

    async add($question) {
        await Csrf.getCookie();

        return Api.post("/posts", { 'question': $question });
    },

    async deletepost($id) {
        await Csrf.getCookie();

        return Api.post("/delete", { 'id': $id });
    },

    async approvepost($id) {
        await Csrf.getCookie();

        return Api.post("/approve", { 'id': $id });
    },

    async rejectpost($id) {
        await Csrf.getCookie();

        return Api.post("/reject", { 'id': $id });
    },

    async addcomment($id, $comment) {
        await Csrf.getCookie();

        return Api.post("/comments", { 'post_id': $id, 'comment': $comment });
    }
}