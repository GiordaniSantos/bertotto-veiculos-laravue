<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    const CAMBIO_MANUAL = 1;
    const CAMBIO_AUTOMATICO = 2;
    const CAMBIO_CVT = 3;

    public static $tiposCambio = [
        self::CAMBIO_MANUAL => 'Câmbio Manual',
        self::CAMBIO_AUTOMATICO => 'Câmbio Automático',
        self::CAMBIO_CVT => 'Câmbio Automático CVT',
    ];

    const FLEX = 4;
    const DIESEL = 5;
    const GASOLINA = 6;
    const GNV_FLEX = 7;
    const GNV_GASOLINA = 8;
    const ALCOOL = 9;
    const GNV_ALCOOL = 10;
    const ELETRICO = 11;

    public static $tiposCombustivel = [
        self::FLEX => 'Flex',
        self::DIESEL => 'Diesel',
        self::GASOLINA => 'Gasolina',
        self::GNV_FLEX => 'GNV e Flex',
        self::GNV_GASOLINA => 'GNV e Gasolina',
        self::ALCOOL => 'Alcool',
        self::GNV_ALCOOL => 'GNV e Alcool',
        self::ELETRICO => 'Elétrico',
    ];

    protected $fillable = ['nome','descricao', 'marca_id' ,'ano_modelo', 'preco', 'portas', 'cor', 'cambio', 'tipo_combustivel', 'aceita_troca', 'ipva_pago', 'licenciado', 'air_bag',
     'air_bag_duplo', 'alarme', 'ar_condicionado_digital', 'banco_couro', 'banco_regulavel_altura', 'chave_reserva', 'computador_bordo', 'desembacador_traseiro',
        'direcao_eletrica', 'direcao_escamoteavel', 'direcao_multifuncional', 'farois_auxiliares', 'farois_led', 'freios_abs', 'interface', 'limpador_traseiro', 'manual_proprietario', 'porta_malas_eletrico'
        , 'retrovisor_eletrico', 'liga_leve', 'sensor_chuva', 'sensor_estacionamento', 'som_volante', 'som_original', 'teto_panoramico', 'teto_solar', 'travas_eletricas', 'vidros_eletricos', 'ativo', 'destaque', 'recomendado', 'km'
    ];

    public static function rules(){
        return [
            'nome' => 'required|max:350',
            'ano_modelo' => 'required|max:25',
            'preco' => 'max:25',
            'cor' => 'max:25',
            'arquivo' => 'image'
        ];
    }

    public static function feedback(){
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.max' => 'O campo :attribute não pode ultrapassar 350 caracteres.',
            'ano_modelo.max' => 'O campo :attribute não pode ultrapassar 25 caracteres.',
            'preco.max' => 'O campo :attribute não pode ultrapassar 25 caracteres.',
            'cor.max' => 'O campo :attribute não pode ultrapassar 25 caracteres.',
            'arquivo.image' => "Tipo não suportado, envie uma imagem ('jpg, jpeg, png...')"
        ];
    }

    public function getImagemCapa()
    {

        $arquivo = Arquivo::orderBy('posicao','asc')->where('veiculo_id', $this->id)->where(
            'tipo' , Arquivo::TIPO_IMAGEM
        )->first();

        if (!$arquivo) {
            return null;
        }

        return $arquivo;
    }


    public function getImagems()
    {

        $arquivos = Arquivo::orderBy('posicao','asc')->where('veiculo_id', $this->id)->where(
            'tipo' , Arquivo::TIPO_IMAGEM
        )->get();

        if (!$arquivos) {
            return null;
        }

        return $arquivos;
    }

    public function getTituloUrl(){
        $titulo_url = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($this->nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );
        $novoNome = str_replace(".", "-", $titulo_url);
        $tituloUrl = strtolower($novoNome);

        return preg_replace('/[ -]+/' , '-' , $tituloUrl);
    }

    public function arquivos(){
        return $this->hasMany('App\Models\Arquivo');
    }

    public function getTipoCambioFormatado()
    {
        return isset(self::$tiposCambio[$this->cambio]) ? self::$tiposCambio[$this->cambio] : '';
    }

    public function marca(){
        return $this->belongsTo('App\Models\Marca');
    }
}
