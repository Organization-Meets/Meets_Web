// Mapeamento de entidades -> campos editáveis simples
export const ENTITIES = {
  usuarios: {
    label: 'Usuários',
    entity: 'usuarios',
    fields: [
      { name: 'email', label: 'Email', required: true },
      { name: 'password', label: 'Senha', type: 'password', createOnly: true },
      { name: 'status', label: 'Status' },
      { name: 'verified', label: 'Verificado' }
    ]
  },
  administradores: {
    label: 'Administradores',
    entity: 'administradores',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'nome', label: 'Nome', required: true },
      { name: 'ra', label: 'RA', required: true }
    ]
  },
  alunos: {
    label: 'Alunos',
    entity: 'alunos',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'nome', label: 'Nome', required: true },
      { name: 'ra', label: 'RA', required: true }
    ]
  },
  academicos: {
    label: 'Acadêmicos',
    entity: 'academicos',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'nome', label: 'Nome', required: true },
      { name: 'ra', label: 'RA', required: true }
    ]
  },
  gamificacoes: {
    label: 'Gamificações',
    entity: 'gamificacoes',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'nickname', label: 'Nickname' },
      { name: 'scoreTotal', label: 'Score', type: 'number' }
    ]
  },
  atividades: {
    label: 'Atividades',
    entity: 'atividades',
    fields: [
      { name: 'likes', label: 'Likes', type: 'number' },
      { name: 'tipo', label: 'Tipo', required: true }
    ]
  },
  comentarios: {
    label: 'Comentários',
    entity: 'comentarios',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'atividadeId', label: 'Atividade ID' },
      { name: 'descricao', label: 'Descrição', required: true, textarea: true }
    ]
  },
  telefones: {
    label: 'Telefones',
    entity: 'telefones',
    fields: [
      { name: 'numero', label: 'Número', required: true },
      { name: 'ddd', label: 'DDD', required: true },
      { name: 'tipo', label: 'Tipo' }
    ]
  },
  enderecos: {
    label: 'Endereços',
    entity: 'enderecos',
    fields: [
      { name: 'numero', label: 'Número' },
      { name: 'cep', label: 'CEP', required: true }
    ]
  },
  complementos: {
    label: 'Complementos',
    entity: 'complementos',
    fields: [
      { name: 'enderecoId', label: 'Endereco ID', required: true },
      { name: 'nome', label: 'Nome', required: true }
    ]
  },
  lugares: {
    label: 'Lugares',
    entity: 'lugares',
    fields: [
      { name: 'enderecoId', label: 'Endereco ID', required: true },
      { name: 'administradorId', label: 'Administrador ID' },
      { name: 'nome', label: 'Nome', required: true }
    ]
  },
  instituicoes: {
    label: 'Instituições',
    entity: 'instituicoes',
    fields: [
      { name: 'administradorId', label: 'Administrador ID', required: true },
      { name: 'telefoneId', label: 'Telefone ID', required: true },
      { name: 'enderecoId', label: 'Endereco ID', required: true },
      { name: 'nome', label: 'Nome', required: true },
      { name: 'codigo', label: 'Código' }
    ]
  },
  adicionais: {
    label: 'Adicionais',
    entity: 'adicionais',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'telefoneId', label: 'Telefone ID' },
      { name: 'enderecoId', label: 'Endereco ID' },
      { name: 'instituicaoId', label: 'Instituição ID' }
    ]
  },
  redes: {
    label: 'Redes',
    entity: 'redes',
    fields: [
      { name: 'adicionalId', label: 'Adicional ID', required: true },
      { name: 'tipo', label: 'Tipo', required: true },
      { name: 'url', label: 'URL', required: true }
    ]
  },
  postagens: {
    label: 'Postagens',
    entity: 'postagens',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'atividadeId', label: 'Atividade ID' },
      { name: 'titulo', label: 'Título', required: true },
      { name: 'descricao', label: 'Descrição', required: true, textarea: true }
    ]
  },
  eventos: {
    label: 'Eventos',
    entity: 'eventos',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'complementoId', label: 'Complemento ID', required: true },
      { name: 'atividadeId', label: 'Atividade ID' },
      { name: 'nome', label: 'Nome', required: true },
      { name: 'descricao', label: 'Descrição', required: true, textarea: true },
      { name: 'dataInicio', label: 'Data Início', required: true },
      { name: 'dataFinal', label: 'Data Final', required: true }
    ]
  },
  chats: {
    label: 'Chats',
    entity: 'chats',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'nome', label: 'Nome', required: true },
      { name: 'tipo', label: 'Tipo' }
    ]
  },
  membros: {
    label: 'Membros',
    entity: 'membros',
    fields: [
      { name: 'chatId', label: 'Chat ID', required: true },
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'role', label: 'Role' }
    ]
  },
  mensagens: {
    label: 'Mensagens',
    entity: 'mensagens',
    fields: [
      { name: 'chatId', label: 'Chat ID', required: true },
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'conteudo', label: 'Conteúdo', required: true, textarea: true }
    ]
  },
  arquivos_mortos: {
    label: 'Arquivos Mortos',
    entity: 'arquivos_mortos',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'tabelaOrigem', label: 'Tabela Origem', required: true },
      { name: 'registroOrigemId', label: 'Registro Origem ID', required: true },
      { name: 'motivoExclusao', label: 'Motivo', textarea: true }
    ]
  },
  denuncias: {
    label: 'Denúncias',
    entity: 'denuncias',
    fields: [
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'arquivoMortoId', label: 'Arquivo Morto ID', required: true },
      { name: 'administradorId', label: 'Administrador ID' },
      { name: 'tipo', label: 'Tipo', required: true },
      { name: 'descricao', label: 'Descrição', required: true, textarea: true },
      { name: 'status', label: 'Status' }
    ]
  },
  participacoes: {
    label: 'Participações',
    entity: 'participacoes',
    fields: [
      { name: 'eventoId', label: 'Evento ID', required: true },
      { name: 'usuarioId', label: 'Usuario ID', required: true },
      { name: 'atividadeId', label: 'Atividade ID' },
      { name: 'statusIntencao', label: 'Status' }
    ]
  }
};

export const ENTITY_ORDER = Object.keys(ENTITIES);
