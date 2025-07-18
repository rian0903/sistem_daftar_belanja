<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

    // Ambil semua data keranjang user, termasuk detail produk
    public function getByUser($user_id) {
        $this->db->select('carts.*, products.name, products.price, products.image');
        $this->db->from('carts');
        $this->db->join('products', 'products.id = carts.product_id');
        $this->db->where('carts.user_id', $user_id);
        return $this->db->get()->result();
    }

    // Tambahkan item ke keranjang (cek dulu apakah sudah ada)
    public function addToCart($data) {
        // Cek apakah item sudah ada di keranjang user
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('product_id', $data['product_id']);
        $existing = $this->db->get('carts')->row();

        if ($existing) {
            // Jika sudah ada, tambahkan quantity
            $this->db->set('quantity', 'quantity + ' . $data['quantity'], false);
            $this->db->where('id', $existing->id);
            return $this->db->update('carts');
        } else {
            // Jika belum ada, tambahkan item baru
            return $this->db->insert('carts', $data);
        }
    }

    // Update quantity item keranjang (bisa tambah atau kurang)
    public function updateQuantity($cart_id, $quantity) {
        $this->db->set('quantity', $quantity);
        $this->db->where('id', $cart_id);
        return $this->db->update('carts');
    }

    // Hapus satu item dari keranjang
    public function deleteItem($cart_id) {
        return $this->db->delete('carts', ['id' => $cart_id]);
    }

    // Hapus semua keranjang milik user tertentu
    public function deleteCart($user_id) {
        return $this->db->delete('carts', ['user_id' => $user_id]);
    }

    // Kurangi stok produk (dipanggil saat checkout)
    public function kurangiStok($product_id, $jumlah) {
        $this->db->set('stock', 'stock - ' . $jumlah, false);
        $this->db->where('id', $product_id);
        return $this->db->update('products');
    }
}
