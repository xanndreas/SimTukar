<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\NewsPage;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Comment::with(['berita'])->select(sprintf('%s.*', (new Comment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'comment_show';
                $editGate = 'comment_edit';
                $deleteGate = 'comment_delete';
                $crudRoutePart = 'comments';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('name', function ($row) {
                return $row->user ? $row->name : '';
            });
            $table->addColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->editColumn('content', function ($row) {
                return $row->content ? $row->content : '';
            });

            $table->editColumn('report_count', function ($row) {
                return $row->report_count ? $row->report_count : '';
            });
            $table->addColumn('berita_title', function ($row) {
                return $row->berita ? $row->berita->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'berita']);

            return $table->make(true);
        }

        $users      = User::get();
        $news_pages = NewsPage::get();

        return view('admin.comments.index', compact('users', 'news_pages'));
    }

    public function create()
    {
        abort_if(Gate::denies('comment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $beritas = NewsPage::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.comments.create', compact('users', 'beritas'));
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->all());

        return redirect()->route('admin.comments.index');
    }

    public function edit(Comment $comment)
    {
        abort_if(Gate::denies('comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $beritas = NewsPage::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $comment->load('user', 'berita');

        return view('admin.comments.edit', compact('users', 'beritas', 'comment'));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());

        return redirect()->route('admin.comments.index');
    }

    public function show(Comment $comment)
    {
        abort_if(Gate::denies('comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comment->load('user', 'berita');

        return view('admin.comments.show', compact('comment'));
    }

    public function destroy(Comment $comment)
    {
        abort_if(Gate::denies('comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comment->delete();

        return back();
    }

    public function massDestroy(MassDestroyCommentRequest $request)
    {
        Comment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
