<?php
    class PessoaFisica{
        private $pf_id;
        private $pf_cpf;
        private $pf_nome;
        private $pf_dt_nascimento;
        
        public function __construct($id, $cpf, $nome, $dtNasci){
            
            $this->pf_id = $id;
            $this->pf_cpf = $cpf;
            $this->pf_nome = $nome;
            $this->pf_dt_nascimento = $dtNasci;
        }

        public function getID(){ return $this->pf_id; }
        public function setID($id){
            if  ($id > 0 && $id <> "")
                    $this->pf_id = $id; 
            else
                throw new Exception("Código de pessoa física inválido:".$id);
        }

        public function getCpf(){ return $this->pf_cpf; }
        public function setCpf($cpf){
            if  ($cpf > 0 && $cpf <> "")
                    $this->pf_cpf = $cpf; 
            else
                throw new Exception("CPF inválido:".$id);
        }

        public function getNome(){ return $this->pf_nome; }
        public function setNome($nome){
            if  ($nome > 0 && $nome <> "")
                    $this->pf_nome = $nome; 
            else
                throw new Exception("CPF inválido:".$nome);
        }

        public function getDtNascimento(){ return $this->pf_dt_nascimento; }
        public function setDtNascimento($dtNasci){
            if  ($dtNasci > 0 && $dtNasci <> "")
                    $this->pf_dt_nascimento = $dtNasci; 
            else
                throw new Exception("CPF inválido:".$nome);
        }

        public function buscar($id){

            require_once("conf/Conexao.php");
            $conexao = Conexao::getInstance();
            $query = 'SELECT * FROM pessoa_fisica';
            if ($id < 0){
                    $query .= 'WHERE pf_id = :id';
                    $stmt->bindParam(':id', $id);
            }

            $stmt = $conexao->prepare($query);
            if ($stmt->execute())
                 return $stmt->fetchAll();

            return false;
        }

        public function inserir(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO pessoa_fisica (pf_nome, pf_cpf, pf_dt_nascimento) VALUES(:pf_nome, :pf_cpf, :pf_dt_nascimento)');
            $stmt->bindParam(':pf_nome', $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(':pf_cpf', $this->cpf, PDO::PARAM_STR);
            $stmt->bindParam(':pf_dt_nascimento', $this->dtNasci, PDO::PARAM_STR);
    
            return $stmt->execute();
            
        }

        public function editar($id){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE pessoa_fisica SET pf_nome = :pf_nome, pf_cpf = :pf_cpf, pf_dt_nascimento = :pf_dt_nascimento WHERE pf_id = :pf_id');
            $stmt->bindParam(':pf_id', $this->id, PDO::PARAM_STR);
            $stmt->bindParam(':pf_nome', $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(':pf_cpf', $this->cpf, PDO::PARAM_STR);
            $stmt->bindParam(':pf_dt_nascimento', $this->dtNasci, PDO::PARAM_STR);
    

    
            return $stmt->execute();
            
        }


        function excluir($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM pessoa_fisica WHERE pf_id = :pf_id');
            $stmt->bindParam(':pf_id', $pf_id);
            
            return $stmt->execute();
        }
    }
?>