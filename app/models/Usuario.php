<?php

class Usuario
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getUsuarios($offset = 0, $limit = 10)
    {
        $offset = (int)$offset;
        $limit = (int)$limit;

        $sql = "SELECT u.*, c.caja AS caja FROM usuarios u
                    JOIN cajas c ON c.id_caja = u.id_caja
                    ORDER BY nombre ASC
                    LIMIT $limit OFFSET $offset";
        return $this->db->fetchAll($sql);
    }

    public function getTotalUsuarios()
    {
        $sql = "SELECT COUNT(*) as total FROM usuarios";
        $result = $this->db->fetch($sql);
        return $result['total'] ?? 0;
    }

    public function getUsuario($id)
    {
        return $this->db->fetch("SELECT * FROM usuarios WHERE id = ?", [$id]);
    }

    public function getUsuarioByNick($nick)
    {
        return $this->db->fetch("SELECT * FROM usuarios WHERE nick = ?", [$nick]);
    }

    public function validatePassword($clave, $claveHash)
    {
        return password_verify($clave, $claveHash);
    }

    public function crear($datos)
    {
        return $this->db->insert('usuarios', $datos);
    }

    public function actualizar($id, $datos)
    {
        return $this->db->update('usuarios', $datos, 'id = ?', [$id]);
    }

    public function eliminar($id)
    {
        return $this->db->delete('usuarios', 'id = ?', [$id]);
    }
}
