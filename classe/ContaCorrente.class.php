<?php
    class ContaCorrente{
        private $cc_numero;
        private $cc_saldo;
        private $cc_pf_id;
        private $cc_dt_ultima_alteracao;
        
        public function __construct($id, $saldo, $cc_pf, $dt){
            
            $this->cc_numero = $id;
            $this->cc_saldo = $saldo;
            $this->cc_pf_id = $cc_pf;
            $this->cc_dt_ultima_alteracao = $dt;
        } 

        public function getID(){ return $this->cc_numero; }
        public function setID($id){
            if  ($cc_numero > 0 && $cc_numero <> "")
                    $this->cc_numero = $id; 
            else
                throw new Exception("Número de conta inválido:".$id);
        }

        public function getSaldo(){ return $this->cc_saldo; }
        public function setSaldo($saldo){ 
            if ($cc_saldo > 0 && $cc_saldo <>"")
                $this->cc_saldo = $saldo; 
            else
                throw new Exception("Saldo de conta inválido:".$saldo);

            }

        public function getPf(){ return $this->cc_pf_id; }
        public function setPf($cc_pf){ 
            if ($cc_pf > 0 && $cc_pf <>"")
                $this->cc_pf_id = $cc_pf; 
            else
                throw new Exception("Pessoa Física inválida:".$cc_pf);

            }

        public function getDtUltimaAlteracao(){ return $this->cc_dt_ultima_alteracao; }
        public function setDtUltimaAlteracao($dt){ 
            if ($dt > 0 && $dt <>"")
                $this->cc_dt_ultima_alteracao = $dt; 
            else
                throw new Exception("Data de Última Alteração inválida:".$dt);

            }

        public function insere(){
            require_once("Conexao.php");
            $conexao = Conexao::getInstance();
            $query = 'INSERT INTO TABLE conta_corrente
            VALUES (:numero, :saldo, :pf_id, :dt)';

            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':numero',$this->cc_numero);
            $stmt->bindParam(':saldo',$this->cc_saldo);
            $stmt->bindParam(':pf_id',$this->cc_pf_id);
            $stmt->bindParam(':dt',$this->dt_ultima_alteracao);

            return $stmt->execute();
        }
       
        public function buscar($id){
// id da pessoa
            require_once("conf/Conexao.php");
            $conexao = Conexao::getInstance();
            $query = 'SELECT * FROM conta_corrente';
            if ($id < 0){
                    $query .= 'WHERE cc_pf_id = :id';
                    $stmt->bindParam(':id', $id);
            }

            $stmt = $conexao->prepare($query);
            if ($stmt->execute())
                 return $stmt->fetchAll();

            return false;
        }
}

?>