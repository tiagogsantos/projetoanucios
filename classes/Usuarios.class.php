<?php

class Usuarios {

    public function getTotalUsuarios ()
    {
        global $pdo;

        $sql = $pdo->query("SELECT COUNT(*) as u FROM usuarios");
        $row = $sql->fetch();

        return $row['u'];
    }

    /*
     * Metodo para cadastrar um usuario,
     */
    public function cadastrar ($nome, $email, $senha, $telefone)
    {
        global $pdo;

        // Selecionando se existe usuario atraves do email
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        // Se eu nao tiver o usuario ja cadastrado realizo o cadastro do mesmo
        if($sql->rowCount() == 0) {
            $sql = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, 
                                senha = :senha, telefone = :telefone");
            $sql->bindValue("nome", $nome);
            $sql->bindValue("email", $email);
            $sql->bindValue("senha", md5($senha));
            $sql->bindValue("telefone", $telefone);
            $sql->execute();

            return true;
        } else {
            return false;
        }
    }

    public function editarUsuario ($nome, $email, $senha, $telefone, $id)
    {
        global $pdo;

        $sql = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, telefone = :telefone");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->bindValue(":telefone", $telefone);
        $sql->execute();
    }

    /*
     * Metodo para retornar o usuario logado
     */
    public function login ($email, $senha)
    {
        global $pdo;

        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            $_SESSION['cLogin'] = $dado['id'];
            return true;
        } else {
            return false;
        }
    }

    // Retornando o nome do usuario logado
    public function Logado ()
    {
        $array = array();
        global $pdo;

        // Fazendo o select de qual usuario encontra-se logado.
        $sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $_SESSION['cLogin']);
        $sql->execute();

        if ($sql->rowCount()) {
            $nomeUsuario = $sql->fetch();
        } else {
            return $array;
        }
        return $nomeUsuario;
    }

    public function UserID ()
    {
        global $pdo;

        // Fazendo o select de qual usuario encontra-se logado.
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $_SESSION['cLogin']);
        $sql->execute();

        if ($sql->rowCount()) {
            $infoUser = $sql->fetch();
        }

        return $infoUser;
    }
}

?>